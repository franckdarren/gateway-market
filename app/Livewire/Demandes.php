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
                TextColumn::make('compte_type')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('montant')
                    ->searchable()
                    ->formatStateUsing(function ($state, $record) {
                        $prefix = ($record->type === 'depot' || $record->type === 'investissement') ? '+' : '-';
                        return $prefix . ' ' . number_format($state, 0, '', ' ') . ' FCFA';
                    })
                    ->sortable(),

                TextColumn::make('type')
                    ->searchable()
                    ->badge()
                    ->color(fn(?string $state): string => match ($state) {
                        'Investissement' => 'gray',
                        'Retrait' => 'warning',
                        'Dépot' => 'success',
                    })
                    ->sortable(),

                TextColumn::make('description')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('mode_retrait')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('numero_compte')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nom_compte')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('statut')
                    ->searchable()
                    ->badge()
                    ->color(fn($state) => $state == 'Traitée' ? 'success' : 'gray')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->searchable()
                    ->label('Date')
                    ->sortable(),

            ])
            ->filters([])
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
