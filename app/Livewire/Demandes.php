<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BonPesee;
use Filament\Tables\Table;
use App\Models\CompteAdmin;
use App\Models\Transaction;
use App\Models\CompteStartup;
use App\Mail\NotificationDepot;
use App\Mail\NotificationRetrait;
use App\Models\CompteInvestisseur;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
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
use Filament\Forms\Components\Placeholder;
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
                    ->where(function ($query) {
                        $query->where('type', 'retrait')
                            ->orWhere('type', 'depot');
                    })
                    ->where('statut', 'En attente de traitement')
                    ->orderByDesc('created_at'); // Trier par date décroissante
            })

            ->columns([
                TextColumn::make('nom_compte')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('compte_type')
                    ->searchable()
                    ->label('Type compte')
                    ->sortable(),

                TextColumn::make('type')
                    ->searchable()
                    ->badge()
                    ->color(fn($state) => $state == 'Dépot' ? 'success' : 'danger')
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
                // Filtrer par le mode de retrait
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
                            ->placeholder('Choisir un mode de retrait') // Ajout d'un placeholder pour clarifier
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['mode_retrait'])) {
                            $query->where('mode_retrait', $data['mode_retrait']);
                        }
                    })
                    ->indicateUsing(function (array $data) {
                        return !empty($data['mode_retrait']) ? "Mode de retrait : {$data['mode_retrait']}" : null;
                    }),

                // Filtrer par le type de compte
                Filter::make('compte_type')
                    ->label('Filtrer par le type de compte')
                    ->form([
                        Select::make('compte_type')
                            ->label('Type de compte')
                            ->options([
                                'Compte Investisseur' => 'Compte Investisseur',
                                'Compte Startup' => 'Compte Startup',
                            ])
                            ->placeholder('Choisir un type de compte')
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['compte_type'])) {
                            $query->where('compte_type', $data['compte_type']);
                        }
                    })
                    ->indicateUsing(function (array $data) {
                        return !empty($data['compte_type']) ? "Type de compte : {$data['compte_type']}" : null;
                    }),

                // Filtrer par le type de transaction
                Filter::make('type')
                    ->label('Filtrer par le type de transaction')
                    ->form([
                        Select::make('type')
                            ->label('Type de transaction')
                            ->options([
                                'Dépot' => 'Dépot',
                                'Retrait' => 'Retrait',
                            ])
                            ->placeholder('Choisir un type de transaction')
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['type'])) {
                            $query->where('type', $data['type']);
                        }
                    })
                    ->indicateUsing(function (array $data) {
                        return !empty($data['type']) ? "Type de transaction : {$data['type']}" : null;
                    }),
            ])
            ->actions([

                // Valider un retrait
                Action::make('envoyer')
                    ->label("Confirmer l'envoi")
                    ->color('primary') // Couleur du bouton
                    ->visible(fn($record) => $record->statut === 'En attente de traitement' && $record->type === 'Retrait')
                    ->form([
                        TextInput::make('numero_transaction')
                            ->label('Numéro de transaction')
                            ->required()
                            ->placeholder('Exemple : TRX12345'),
                    ])
                    ->action(function (array $data, $record) {

                        if ($record->compte_type === "Compte Investisseur") {
                            $compte = CompteInvestisseur::find($record->compte_id);
                        } elseif ($record->compte_type === "Compte Admin") {
                            $compte = CompteAdmin::find($record->compte_id);
                        } elseif ($record->compte_type === "Compte Startup") {
                            $compte = CompteStartup::find($record->compte_id);
                        }

                        // Marquer la transaction comme traitée
                        $record->update([
                            'statut' => 'Traitée',
                            'numero_transaction' => $data['numero_transaction'],
                        ]);

                        // Notification de succès
                        Notification::make()
                            ->title('Transaction traitée')
                            ->body("La transaction #{$record->id} a été traitée avec succès.")
                            ->success()
                            ->send();

                        // Envoi d'un email de notification
                        Mail::to($compte->email)->send(new NotificationRetrait($record));
                    }),

                // Valider un dépot
                Action::make('déposer')
                    ->label("Confirmer le dépot")
                    ->color('primary') // Couleur du bouton
                    ->visible(fn($record) => $record->statut === 'En attente de traitement' && $record->type === 'Dépot')
                    ->form([
                        // Conteneur principal en grille avec deux colonnes
                        Grid::make(2) // Définir une grille avec 2 colonnes
                            ->schema([
                                Placeholder::make('numero_transaction')
                                    ->label('Numéro de transaction')
                                    ->content(fn($record) => $record->numero_transaction),
                                Placeholder::make('montant')
                                    ->label('Montant')
                                    ->content(fn($record) => number_format($record->montant, 0, '.', ' ') . ' FCFA'),
                                Placeholder::make('mode_retrait')
                                    ->label('Mode de dépot')
                                    ->content(fn($record) => $record->mode_retrait),
                                Placeholder::make('compte_type')
                                    ->label('Type de compte')
                                    ->content(fn($record) => $record->compte_type),
                                Placeholder::make('numero_compte')
                                    ->label('Numéro du compte')
                                    ->content(fn($record) => $record->numero_compte),
                                Placeholder::make('nom_compte')
                                    ->label('Nom du compte')
                                    ->content(fn($record) => $record->nom_compte),
                                Placeholder::make('created_at')
                                    ->label('Date de création')
                                    ->content(fn($record) => $record->created_at->format('d/m/Y H:i')),
                            ]),
                    ])
                    ->action(function (array $data, $record) {

                        if ($record->compte_type === "Compte Investisseur") {
                            $compte = CompteInvestisseur::find($record->compte_id);
                        } elseif ($record->compte_type === "Compte Admin") {
                            $compte = CompteAdmin::find($record->compte_id);
                        } elseif ($record->compte_type === "Compte Startup") {
                            $compte = CompteStartup::find($record->compte_id);
                        }

                        // Effectuer les opérations financières
                        $compte->solde += $record->montant;
                        $compte->save();


                        // Envoyer l'email au compte
                        Mail::to($compte->email)->send(new NotificationDepot($record));

                        // Marquer la transaction comme traitée
                        $record->update([
                            'statut' => 'Traitée',
                        ]);

                        // Notification de succès
                        Notification::make()
                            ->title('Transaction traitée')
                            ->body("La transaction #{$record->id} a été traitée avec succès.")
                            ->success()
                            ->send();
                    })
            ])
            ->bulkActions([]);
    }

    public function render()
    {
        return view('livewire.demandes');
    }
}
