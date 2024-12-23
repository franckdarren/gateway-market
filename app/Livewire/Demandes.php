<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BonPesee;
use Filament\Tables\Table;
use App\Models\CompteAdmin;
use App\Models\Transaction;
use App\Models\CompteStartup;
use App\Models\CompteInvestisseur;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;

use App\Filament\Exports\BonPeseeExporter;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Tables\Concerns\InteractsWithTable;

class Demandes extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return Transaction::query()
                    ->where('type', 'retrait') // Filtrer uniquement les transactions de type "retrait"
                    ->orderByDesc('created_at'); // Trier par date décroissante
            })

            ->columns([
                TextColumn::make('nom_compte')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('compte_type')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('numero_compte')
                    ->searchable()
                    ->label('Numéro ou RIB')
                    ->sortable(),

                TextColumn::make('montant')
                    ->searchable()
                    ->formatStateUsing(function ($state, $record) {
                        return number_format($state, 0, '', ' ') . ' FCFA';
                    })
                    ->sortable(),

                TextColumn::make('mode_retrait')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('statut')
                    ->searchable()
                    ->badge()
                    ->color(fn($state) => $state == 'Traitée' ? 'success' : 'gray')
                    ->sortable(),

                    TextColumn::make('created_at')
                    ->searchable()
                    ->label('Date création')
                    ->sortable()
                    ->formatStateUsing(fn($state) => \Carbon\Carbon::parse($state)
                        ->locale('fr') // Utilise la locale française
                        ->isoFormat('D MMMM YYYY [à] HH[h]mm')),

            ])
            ->filters([
                // FIltrer par le mode de retrait
                Filter::make('mode_retrait')
                    ->label('Filtrer par mode de retrait')
                    ->form([
                        Select::make('mode_retrait')
                            ->label('Mode de retrait')
                            ->options([
                                'AirtelMoney' => 'AirtelMoney',
                                'MoovMoney' => 'MoovMoney',
                                'Virement' => 'Virement',
                            ])
                    ])
                    ->query(function (Builder $query, $data) {
                        if (!empty($data['mode_retrait'])) {
                            $query->where('mode_retrait', $data['mode_retrait']);
                        }
                    })
                    ->indicateUsing(function ($data) {
                        return !empty($data['mode_retrait']) ? "Mode de retrait: {$data['mode_retrait']}" : null;
                    }),

                // FIltrer par le type de compte
                Filter::make('compte_type')
                    ->label('Filtrer par le type de compte')
                    ->form([
                        Select::make('compte_type')
                            ->label('Type de compte')
                            ->options([
                                'Compte Investisseur' => 'Compte Investisseur',
                                'Compte Startup' => 'Compte Startup',
                            ])
                    ])
                    ->query(function (Builder $query, $data) {
                        if (!empty($data['compte_type'])) {
                            $query->where('compte_type', $data['compte_type']);
                        }
                    })
                    ->indicateUsing(function ($data) {
                        return !empty($data['compte_type']) ? "Type de compte: {$data['compte_type']}" : null;
                    }),
            ])
            ->actions([
                Action::make('envoyer')
                    ->label("Confirmer l'envoi")
                    ->color('primary') // Couleur du bouton
                    ->visible(fn($record) => $record->statut === 'En attente de traitement') // Bouton visible uniquement pour ce statut
                    ->form([
                        TextInput::make('numero_transaction')
                            ->label('Numéro de transaction')
                            ->required()
                            ->placeholder('Exemple : TRX12345'),
                    ])
                    ->action(function (array $data, $record) {
                        // Mise à jour du statut et ajout du numéro de transaction
                        $record->update([
                            'statut' => 'En cours de traitement',
                            'numero_transaction' => $data['numero_transaction'], // Sauvegarde du numéro de transaction
                        ]);

                        // Notification de succès
                        Notification::make()
                            ->title('Statut mis à jour')
                            ->body("La transaction #{$record->id} est maintenant en cours de traitement avec le numéro de transaction {$data['numero_transaction']}.")
                            ->success()
                            ->send();
                    })

            ])
            ->bulkActions([])
            ->poll(5);
    }

    public function render()
    {
        return view('livewire.demandes');
    }
}
