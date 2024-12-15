<?php

namespace App\Livewire;

use App\Models\Offre;
use Livewire\Component;
use App\Models\BonPesee;
use Filament\Tables\Table;
use App\Models\CompteAdmin;
use App\Models\Transaction;
use App\Models\CompteStartup;
use App\Models\CompteInvestisseur;
use Filament\Actions\StaticAction;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\BonPeseeExporter;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Tables\Concerns\InteractsWithTable;

class ListOffre extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Offre::query())

            ->columns([
                TextColumn::make('nom_projet')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('montant')
                    ->searchable()
                    ->formatStateUsing(function ($state, $record) {
                        return number_format($state, 0, '', ' ') . ' FCFA';
                    })
                    ->sortable(),

                TextColumn::make('nbre_mois_remboursement')
                    ->label("Mois remboursement")
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nbre_mois_grace')
                    ->label("Mois de grace")
                    ->searchable()
                    ->sortable(),

                TextColumn::make('taux_interet')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('statut')
                    ->searchable()
                    ->badge()
                    ->color(fn(?string $state): string => match ($state) {
                        'En attente de validation' => 'warning',
                        'En cours' => 'success',
                        'Disponible' => 'gray',
                    })
                    ->sortable(),

            ])
            ->filters([])
            ->actions([

                //Affichage pdf Business Plan
                Action::make('url_business_plan')
                    ->label('Business Plan')
                    ->modalContent(fn(Offre $record) => new HtmlString(
                        '<iframe src="' . Storage::disk('public')->url($record->url_business_plan) . '" width="100%" height="600px"></iframe>'
                    ))
                    ->modalWidth('7xl')
                    ->requiresConfirmation(false)
                    ->modalSubmitAction(false)
                    ->modalFooterActionsAlignment('right')
                    ->modalCancelAction(fn(StaticAction $action) => $action),

                //Affichage pdf Business Plan
                Action::make('url_etude_risque')
                    ->label('Etude de risque')
                    ->modalContent(fn(Offre $record) => new HtmlString(
                        '<iframe src="' . Storage::disk('public')->url($record->url_etude_risque) . '" width="100%" height="600px"></iframe>'
                    ))
                    ->modalWidth('7xl')
                    ->requiresConfirmation(false)
                    ->modalSubmitAction(false)
                    ->modalFooterActionsAlignment('right')
                    ->modalCancelAction(fn(StaticAction $action) => $action),

                // Bouton personnalisé "Modifier"
                Action::make('modifier')
                    ->label('Modifier')
                    ->icon('heroicon-o-pencil')
                    ->action(function (Offre $record, array $data): void {
                        $record->update($data); // Met à jour l'enregistrement
                    })
                    ->form(function (Offre $record) {
                        return [
                            Grid::make(2) // Deux colonnes
                                ->schema([
                                    TextInput::make('nom_projet')
                                        ->required()
                                        ->default($record->nom_projet),

                                    TextInput::make('montant')
                                        ->numeric()
                                        ->required()
                                        ->default($record->montant),

                                    TextInput::make('nbre_mois_remboursement')
                                        ->numeric()
                                        ->label('Mois de remboursement')
                                        ->required()
                                        ->default($record->nbre_mois_remboursement),

                                    TextInput::make('nbre_mois_grace')
                                        ->numeric()
                                        ->label('Mois de grâce')
                                        ->required()
                                        ->default($record->nbre_mois_grace),

                                    TextInput::make('taux_interet')
                                        ->numeric()
                                        ->required()
                                        ->default($record->taux_interet),

                                    TextInput::make('van')
                                        ->numeric()
                                        ->required()
                                        ->default($record->van),

                                    TextInput::make('ir')
                                        ->numeric()
                                        ->required()
                                        ->default($record->ir),

                                    TextInput::make('tri')
                                        ->numeric()
                                        ->required()
                                        ->default($record->tri),

                                    TextInput::make('krl')
                                        ->numeric()
                                        ->required()
                                        ->default($record->krl),

                                    Select::make('statut')
                                        ->options([
                                            'En attente de validation' => 'En attente de validation',
                                            'Disponible' => 'Disponible',
                                        ])
                                        ->default($record->statut)
                                        ->required(),

                                    FileUpload::make('url_business_plan')
                                        ->label('Business Plan')
                                        ->acceptedFileTypes(['application/pdf'])
                                        ->directory('pdf/business_plans')
                                        ->visibility('public')
                                        ->default(fn($record) => $record->url_business_plan),

                                    FileUpload::make('url_etude_risque')
                                        ->label('Étude de risque')
                                        ->acceptedFileTypes(['application/pdf'])
                                        ->directory('pdf/etudes_risque')
                                        ->visibility('public')
                                        ->default(fn($record) => $record->url_etude_risque),

                                ]),
                        ];
                    }),
            ])
            ->bulkActions([])
            ->poll(5);
    }

    public function render()
    {
        return view('livewire.list-offre');
    }
}
