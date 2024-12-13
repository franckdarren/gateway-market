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

            ])
            ->bulkActions([])
            ->poll(5);
    }

    public function render()
    {
        return view('livewire.list-investisseur');
    }
}
