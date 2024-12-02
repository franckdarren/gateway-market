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
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([])
            ->actions([
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
                        // Création manuelle de la transaction sans utiliser la relation morphique
                        Transaction::create([
                            'montant' => $data['montant'],
                            'type' => 'depot',
                            'description' => "Dépôt d'argent au compte " . $record->nom,
                            'compte_type' => "Compte Startup", // Valeur fixe
                            'compte_id' => $record->id,
                            'statut' => 'En attente de traitement',
                        ]);
                    }),

                // Modifier le type d'abonnement
                Action::make('modifierTypeAbonnement')
                    ->label("Modifier le type d'abonnement")
                    ->modalHeading("Modifier le type d'abonnement")
                    ->form([
                        Select::make('type_abonnement')
                            ->label('Type d\'abonnement')
                            ->required()
                            ->options([
                                'Premium' => 'Premium',
                                'Simple' => 'Simple',
                            ])
                            ->placeholder('Choisissez un type d\'abonnement'),
                    ])
                    ->action(function (array $data, $record) {
                        $user = $record->user; // Récupère l'utilisateur associé au compte startup

                        if ($user) {
                            $user->update([
                                'type_abonnement' => $data['type_abonnement'],
                            ]);
                        }
                    })
                    ->requiresConfirmation()
                    ->modalWidth('md')
                    ->color('success'),
            ])
            ->bulkActions([]);
    }
    public function render()
    {
        return view('livewire.list-startup');
    }
}
