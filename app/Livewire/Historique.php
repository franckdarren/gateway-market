<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\BonPesee;
use Filament\Tables\Table;
use App\Models\CompteAdmin;
use App\Models\Transaction;
use App\Models\CompteStartup;
use App\Models\CompteInvestisseur;
use Filament\Tables\Filters\Filter;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\BonPeseeExporter;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Tables\Concerns\InteractsWithTable;


class Historique extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $user = auth()->user();

                // Récupérer le rôle de l'utilisateur
                $userRole = $user->getRoleNames()->first();

                if ($userRole === 'Administrateur') {
                    // L'administrateur voit toutes les transactions, triées par date décroissante
                    return Transaction::query()->orderByDesc('created_at');
                }

                // Déterminer le compte associé en fonction du rôle
                $compte = null;

                if ($userRole === 'Investisseur') {
                    $compte = $user->compteInvestisseur; // Relation directe
                    $typeCompte = 'Compte Investisseur';
                } elseif ($userRole === 'Startup') {
                    $compte = $user->compteStartup; // Relation directe
                    $typeCompte = 'Compte Startup';
                }

                if (!$compte) {
                    session()->flash('error', 'Aucun compte valide trouvé pour l\'utilisateur.');
                    return Transaction::query()->whereRaw('0 = 1'); // Requête vide
                }

                // Filtrer les transactions par `compte_id` et trier par date décroissante
                return Transaction::where('compte_id', $compte->id)
                    ->where('compte_type', $typeCompte)
                    ->orderByDesc('created_at');
            })

            ->columns([
                TextColumn::make('compte.nom_complet')
                    ->label('Nom')
                    ->sortable(),

                TextColumn::make('compte.nom')
                    ->hidden()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('compte.prenom')
                    ->hidden()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('compte_type')
                    ->label('Nature')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('montant')
                    ->searchable()
                    ->formatStateUsing(function ($state, $record) {
                        $prefix = ($record->type === 'Dépot' || $record->type === 'Commission' || $record->type === 'Remboursement crédit') ? '+' : '-';
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
                        'Remboursement débit' => 'warning',
                        'Remboursement crédit' => 'success',
                        'Remboursement ERREUR' => 'danger',
                        'Commission' => 'info',
                    })
                    ->sortable(),

                TextColumn::make('description')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('compte.solde')
                    ->label('Solde')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn(string|int|null $state): string => $state ? number_format($state, 0, '.', ' ') . ' FCFA' : '0 FCFA'),


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

                TextColumn::make('numero_transaction')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->searchable()
                    ->label('Date création')
                    ->sortable()
                    ->formatStateUsing(fn($state) => \Carbon\Carbon::parse($state)
                        ->locale('fr') // Utilise la locale française
                        ->isoFormat('D MMMM YYYY [à] HH[h]mm')), // Format souhaité : 12 janvier 2024 à 14h30
            ])
            ->filters([
                // Filtrer par le type de transaction
                Filter::make('type')
                    ->label('Filtrer par le type de transaction')
                    ->form([
                        Select::make('type')
                            ->label('Type de transaction')
                            ->options([
                                'Investissement' => 'Investissement',
                                'Retrait' => 'Retrait',
                                'Dépot' => 'Dépot',
                                'Remboursement débit' => 'Remboursement débit',
                                'Remboursement crédit' => 'Remboursement crédit',
                                'Remboursement ERREUR' => 'Remboursement ERREUR',
                                'Commission' => 'Commission',
                            ])
                    ])
                    ->query(function (Builder $query, $data) {
                        if (!empty($data['type'])) {
                            $query->where('type', $data['type']);
                        }
                    })
                    ->indicateUsing(function ($data) {
                        return !empty($data['type']) ? "Type de compte: {$data['type']}" : null;
                    }),

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

                //Filtrer par période
                // Filter::make('created_at')
                //     ->label('Filtrer par période')
                //     ->form([
                //         DatePicker::make('date_debut')
                //             ->label('Date de début'),
                //         DatePicker::make('date_fin')
                //             ->label('Date de fin')
                //             ->placeholder('Choisissez une date de fin')
                //     ])
                //     ->query(function (Builder $query, $data) {
                //         if (!empty($data['date_debut']) && !empty($data['date_fin'])) {
                //             $query->whereBetween('created_at', [$data['date_debut'], $data['date_fin']]);
                //         }
                //     }),

            ])
            ->actions([
                // ...
            ])
            ->bulkActions([]);
    }

    public function render()
    {
        return view('livewire.historique');
    }
}
