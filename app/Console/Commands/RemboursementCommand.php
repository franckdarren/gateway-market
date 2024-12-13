<?php

namespace App\Console\Commands;

use App\Models\Offre;
use App\Models\Transaction;
use App\Models\Remboursement;
use Illuminate\Console\Command;
use App\Mail\RemboursementStartup;
use Illuminate\Support\Facades\Mail;
use App\Mail\RemboursementInvestisseur;
use App\Mail\ErreurRemboursementStartup;
use App\Mail\ErreurRemboursementInvestisseur;

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
        $remboursements = Remboursement::where('mois', $today->translatedFormat('d F Y'))
            ->where('statut', 'En attente de paiement')
            ->get();


        if ($remboursements->isEmpty()) {
            $this->info('Aucun remboursement à traiter.');
            return Command::SUCCESS;
        }

        $dateRemboursement = $today->translatedFormat('d F Y');

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
                $transactionReussi = $startup->transactions()->create([
                    // 'compte_type' => 'Compte Startup',
                    // 'compte_id' => $startup->id,
                    'montant' => $remboursement->remboursement_total,
                    'type' => "Remboursement débit",
                    'description' => "Remboursement pour l'offre {$offre->nom_projet} de " . $dateRemboursement,
                    'statut' => "Traitée",

                ]);

                // Créditer le compte investisseur
                $investisseur->solde += $remboursement->remboursement_total;
                $investisseur->save();

                // Créer la trace dans la table Transaction
                $investisseur->transactions()->create([
                    // 'compte_type' => 'Compte Investisseur',
                    // 'compte_id' => $investisseur->id,
                    'montant' => $remboursement->remboursement_total,
                    'type' => "Remboursement crédit",
                    'description' => "Remboursement du projet {$offre->nom_projet} pour : " . $dateRemboursement,
                    'statut' => "Traitée",

                ]);

                // Changement du statut
                $remboursement->statut = 'Remboursé';
                $remboursement->save();


                // Envoyer l'email à l'investisseur
                Mail::to($investisseur->email)->send(new RemboursementInvestisseur($transactionReussi, $investisseur, $startup));

                // Envoyer l'email à la startup
                Mail::to($startup->email)->send(new RemboursementStartup($transactionReussi, $investisseur, $startup));


                $this->info("Remboursement de {$remboursement->remboursement_total} traité pour l'offre {$remboursement->offre_id}.");
            } else {

                // Créer la trace dans la table Transaction
                $transactionErreur = $startup->transactions()->create([
                    // 'compte_type' => 'Compte Startup',
                    // 'compte_id' => $startup->id,
                    'montant' => $remboursement->remboursement_total,
                    'type' => "Remboursement ERREUR",
                    'description' => "Erreur de remboursement pour l'offre {$offre->nom_projet} de " . $dateRemboursement,
                    'statut' => "Traitée",

                ]);

                $investisseur->transactions()->create([
                    // 'compte_type' => 'Compte Investisseur',
                    // 'compte_id' => $investisseur->id,
                    'montant' => $remboursement->remboursement_total,
                    'type' => "Remboursement ERREUR",
                    'description' => "Erreur de remboursement du projet {$offre->nom_projet} pour : " . $dateRemboursement,
                    'statut' => "Traitée",

                ]);

                // // Changement du statut
                // $remboursement->statut = 'Non Remboursé';
                // $remboursement->save();
                $this->warn("Fonds insuffisants pour le CompteStartup {$startup->nom}.");

                // Envoyer l'email à l'investisseur
                Mail::to($investisseur->email)->send(new ErreurRemboursementInvestisseur($transactionErreur, $investisseur, $startup));

                // Envoyer l'email à la startup
                Mail::to($startup->email)->send(new ErreurRemboursementStartup($transactionErreur, $investisseur, $startup));
            }

            $this->info("Remboursement ID {$remboursement->id} traitée avec succès.");
        }

        $this->info('Traitement des remboursements terminé.');
        return Command::SUCCESS;
    }
}
