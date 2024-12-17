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
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\BonPeseeExporter;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Tables\Concerns\InteractsWithTable;

class ListInvestisseur extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(CompteInvestisseur::query())



            ->columns([
                TextColumn::make('nom')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('prenom')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pays')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('ville')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('solde')
                    ->searchable()
                    ->formatStateUsing(function ($state, $record) {
                        return number_format($state, 0, '', ' ') . ' FCFA';
                    })
                    ->sortable(),

                TextColumn::make('code_postal')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('profession')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([])
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
                            // Création de la transaction en utilisant la relation morphique
                            $record->transactions()->create([
                                'montant' => $data['montant'],
                                'type' => 'Dépot',
                                'description' => "Dépôt d'argent au compte " . $record->nom . ' ' . $record->prenom,
                                // 'compte_type' => "Compte Investisseur",
                                'statut' => 'En attente de traitement',
                            ]);

                            // Notification::make()
                            //     ->title('Dépôt effectué')
                            //     ->success()
                            //     ->body("Un dépôt de {$data['montant']} a été enregistré pour le compte #{$record->id}.")
                            //     ->send();
                        }),

                    Action::make('modifier')
                        ->label('Modifier')
                        ->action(function (CompteInvestisseur $record, array $data): void {
                            // Mettre à jour les données du CompteInvestisseur
                            $record->update($data);

                            // Mettre à jour les données de l'utilisateur lié
                            if (isset($data['user'])) {
                                $record->user()->update($data['user']);
                            }
                        })
                        ->form(function (CompteInvestisseur $record) {
                            return [

                                Grid::make(2) // Deux colonnes pour un affichage propre
                                    ->schema([

                                        Fieldset::make('Information du compte')
                                            ->schema([
                                                // Champs pour CompteInvestisseur
                                                TextInput::make('nom')
                                                    ->required()
                                                    ->default($record->nom),

                                                TextInput::make('prenom')
                                                    ->required()
                                                    ->default($record->prenom),

                                                TextInput::make('pays')
                                                    ->required()
                                                    ->default($record->pays),

                                                TextInput::make('etat_province')
                                                    ->default($record->etat_province),

                                                TextInput::make('ville')
                                                    ->default($record->ville),

                                                TextInput::make('code_postal')
                                                    ->default($record->code_postal),

                                                TextInput::make('phone')
                                                    ->required()
                                                    ->default($record->phone),

                                                TextInput::make('email')
                                                    ->required()
                                                    ->default($record->email),

                                                TextInput::make('profession')
                                                    ->required()
                                                    ->default($record->profession),
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
        return view('livewire.list-investisseur');
    }
}
