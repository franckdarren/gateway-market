<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BonPesee;
use Filament\Tables\Table;
use App\Models\CompteAdmin;
use App\Models\Transaction;
use App\Models\CompteStartup;
use App\Models\CompteInvestisseur;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;

use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\BonPeseeExporter;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Tables\Concerns\InteractsWithTable;

class ListStartup extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(CompteStartup::query())



            ->columns([
                TextColumn::make('nom')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('activite_principale')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('date_creation')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('solde')
                    ->searchable()
                    ->formatStateUsing(function ($state, $record) {
                        return number_format($state, 0, '', ' ') . ' FCFA';
                    })
                    ->sortable(),

                TextColumn::make('user.type_abonnement')
                    ->label("Type d'abonnement")
                    ->searchable()
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                // Filtre en fonction du type d'abonnement
                Filter::make('type_abonnement')
                    ->label('Filtrer par type d\'abonnement')
                    ->form([
                        Select::make('type_abonnement')
                            ->label('Type d\'abonnement')
                            ->options([
                                'Premium' => 'Premium',
                                'Simple' => 'Simple',
                            ])
                    ])
                    ->query(function (Builder $query, $data) {
                        if (!empty($data['type_abonnement'])) {
                            // Jointure avec la table users pour accéder à la colonne type_abonnement
                            $query->whereHas('user', function ($subQuery) use ($data) {
                                $subQuery->where('type_abonnement', $data['type_abonnement']);
                            });
                        }
                    })
                    ->indicateUsing(function ($data) {
                        return !empty($data['type_abonnement']) ? "Statut: {$data['type_abonnement']}" : null;
                    }),

            ])
            ->actions([
                ActionGroup::make([
                    // Faire un dépot
                    Action::make('creerTransaction')
                        ->label("Faire un dépôt d'argent")
                        ->modalHeading("Faire un dépôt d'argent")
                        ->form([
                            TextInput::make('montant')
                                ->numeric()
                                ->required()
                                ->label('Montant'),
                        ])
                        ->action(function (array $data, $record) {
                            // Création manuelle de la transaction en utilisant la relation morphique
                            $record->transactions()->create([
                                'montant' => $data['montant'],
                                'type' => 'Dépot',
                                'description' => "Dépôt d'argent au compte " . $record->nom,
                                // 'compte_type' => "Compte Startup",
                                // 'compte_id' => $record->id,
                                'statut' => 'En attente de traitement',
                            ]);
                        }),

                    Action::make('modifier')
                        ->label('Modifier')
                        ->action(function (CompteInvestisseur $record, array $data): void {
                            // Mettre à jour les données du CompteStartup
                            $record->update($data);

                            // Mettre à jour les données de l'utilisateur lié
                            if (isset($data['user'])) {
                                $record->user()->update($data['user']);
                            }
                        })
                        ->form(function (CompteStartup $record) {
                            return [

                                Grid::make(2) // Deux colonnes pour un affichage propre
                                    ->schema([

                                        Fieldset::make('Information du compte')
                                            ->schema([
                                                // Champs pour CompteStartup
                                                TextInput::make('nom')
                                                    ->required()
                                                    ->default($record->nom),

                                                DatePicker::make('date_creation')
                                                    ->required()
                                                    ->default($record->date_creation),

                                                TextInput::make('activite_principale')
                                                    ->required()
                                                    ->default($record->activite_principale),

                                                TextInput::make('email')
                                                    ->default($record->email),
                                            ]),

                                        Fieldset::make('Information de l\'utilisateur')
                                            ->schema([
                                                // Champs pour User lié
                                                Grid::make(2) // Grid supplémentaire pour les champs User
                                                    ->schema([
                                                        TextInput::make('user.name')
                                                            ->label('Nom de l\'utilisateur')
                                                            ->required()
                                                            ->default($record->user?->name),

                                                        TextInput::make('user.email')
                                                            ->label('Email de l\'utilisateur')
                                                            ->required()
                                                            ->default($record->user?->email),

                                                        Select::make('type_abonnement')
                                                            ->label('Type d\'abonnement')
                                                            ->default($record->user?->type_abonnement)
                                                            ->required()
                                                            ->options([
                                                                'Premium' => 'Premium',
                                                                'Simple' => 'Simple',
                                                            ])
                                                            ->placeholder('Choisissez un type d\'abonnement')
                                                    ]),
                                            ])
                                    ]),
                            ];
                        }),
                ])->label('Action')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size(ActionSize::Small)
                    ->color('primary')
                    ->button(),

            ])
            ->bulkActions([])
            ->poll(5);
    }
    public function render()
    {
        return view('livewire.list-startup');
    }
}
