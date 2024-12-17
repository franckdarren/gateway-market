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
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
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
                    ->label('Date')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('d-m-Y \à H\hi')),

            ])
            ->filters([])
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
