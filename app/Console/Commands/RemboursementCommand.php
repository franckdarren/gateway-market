<?php

namespace App\Console\Commands;

use App\Models\Offre;
use App\Models\Transaction;
use App\Models\Remboursement;
use Illuminate\Console\Command;

class RemboursementCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remboursement:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now();

        // Récupérer tous les remboursements pour le mois actuel
        $remboursements = Remboursements::where('mois', $today->translatedFormat('F Y'))
            ->where('statut', 'En attente de paiement')
            ->get();

        // dd($remboursements);

        if ($remboursements->isEmpty()) {
            $this->info('Aucun remboursement à traiter.');
            return Command::SUCCESS;
        }

        $dateRemboursement = $today->translatedFormat('F Y');

        foreach ($remboursements as $remboursement) {
            $startup = $remboursement->compteStartup;
            $investisseur = $remboursement->compteInvestisseur;
            $offre = $remboursement->offre;

            // Vérifier si la startup a assez de fonds
            if ($startup->solde >= $remboursement->remboursement_total) {
                // Débiter le compte startup
                $startup->solde -= $remboursement->remboursement_total;
                $startup->save();

                // Créer la trace dans la table Transaction
                Transaction::create([
                    'compte_type' => 'Compte Startup',
                    'compte_id' => $startup->id,
                    'montant' => $remboursement->remboursement_total,
                    'type' => "remboursement débit",
                    'description' => "Remboursement pour l'offre {$offre->nom_projet} de " . $dateRemboursement,
                    'statut' => "Traitée",

                ]);

                // Créditer le compte investisseur
                $investisseur->solde += $remboursement->remboursement_total;
                $investisseur->save();

                // Créer la trace dans la table Transaction
                Transaction::create([
                    'compte_type' => 'Compte Investisseur',
                    'compte_id' => $investisseur->id,
                    'montant' => $remboursement->remboursement_total,
                    'type' => "remboursement crédit",
                    'description' => "Remboursement du projet {$offre->nom_projet} pour : " . $dateRemboursement,
                    'statut' => "Traitée",

                ]);

                // Changement du statut
                $remboursement->statut = 'Remboursé';
                $remboursement->save();

                $this->info("Remboursement de {$remboursement->remboursement_total} traité pour l'offre {$remboursement->offre_id}.");
            } else {

                // Créer la trace dans la table Transaction
                Transaction::create([
                    'compte_type' => 'Compte Startup',
                    'compte_id' => $startup->id,
                    'montant' => $remboursement->remboursement_total,
                    'type' => "remboursement ERREUR",
                    'description' => "Erreur de remboursement pour l'offre {$offre->nom_projet} de " . $dateRemboursement,
                    'statut' => "Traitée",

                ]);

                Transaction::create([
                    'compte_type' => 'Compte Investisseur',
                    'compte_id' => $investisseur->id,
                    'montant' => $remboursement->remboursement_total,
                    'type' => "remboursement ERREUR",
                    'description' => "Erreur de remboursement du projet {$offre->nom_projet} pour : " . $dateRemboursement,
                    'statut' => "Traitée",

                ]);

                // Changement du statut
                $remboursement->statut = 'Non Remboursé';
                $remboursement->save();
                $this->warn("Fonds insuffisants pour le CompteStartup {$startup->nom}.");
            }

            $this->info("Remboursement ID {$remboursement->id} traitée avec succès.");
        }

        $this->info('Traitement des remboursements terminé.');
        return Command::SUCCESS;
    }
}
