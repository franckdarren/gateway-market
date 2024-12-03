<?php

namespace App\Console\Commands;

use App\Models\Offre;
use App\Models\CompteAdmin;
use App\Models\Transaction;
use App\Models\CompteStartup;
use App\Models\Remboursement;
use Illuminate\Console\Command;
use App\Mail\NotificationStartup;
use App\Models\CompteInvestisseur;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationInvestisseur;
use App\Mail\AnnulationInvestissement; // Ajouter le mail d'annulation

class InvestissementCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'investissement:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public $montantDepart;
    public $taux_interet;
    public $duree_remboursement;
    public $delaiGrace;
    public $montantEmprunte;
    public $duree;
    public $tauxInteret;
    public $remboursements = [];


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Début du traitement des transactions de type investissement...');

        // Récupérer toutes les transactions "investissement" non traitées
        $investissements = Transaction::where('type', 'investissement')
            ->where('statut', 'En attente de traitement')
            ->get();

        if ($investissements->isEmpty()) {
            $this->info('Aucune transaction de type investissement à traiter.');
            return Command::SUCCESS;
        }

        foreach ($investissements as $transaction) {
            $this->info("Traitement de la transaction ID {$transaction->id}...");

            // Calcul des montants
            $montant = $transaction->montant;
            $montantAdmin = $transaction->frais; // 2%
            $montantStartup = $transaction->montant - $transaction->frais; // 98%
            // $montantDepart = $montantStartup;

            // Récupérer le compte investisseur
            $compteInvestisseur = CompteInvestisseur::find($transaction->compte_id);
            if (!$compteInvestisseur) {
                $this->error("Compte investisseur introuvable pour la transaction ID {$transaction->id}");
                continue;
            }

            // Vérification du solde avant de poursuivre
            if ($compteInvestisseur->solde < $montant) {
                // Si le solde est insuffisant, envoyer un email d'annulation et arrêter l'opération
                $this->error("Solde insuffisant pour la transaction ID {$transaction->id}");


                // Marquer la transaction comme annulée
                $transaction->statut = 'Annulée';
                $transaction->save();

                // Récupérer l'offre et le compte startup
                $offre = Offre::find($transaction->offre_id);
                if (!$offre) {
                    $this->error("Offre introuvable pour la transaction ID {$transaction->id}");
                    continue;
                }

                $offre->statut = 'Disponible';
                $offre->compte_investisseur_id = null;
                $offre->save();

                // Envoi de l'email d'annulation
                Mail::to($compteInvestisseur->email)->send(new AnnulationInvestissement($transaction, $compteInvestisseur));
                continue;
            }

            // Récupérer l'offre et le compte startup
            $offre = Offre::find($transaction->offre_id);
            if (!$offre) {
                $this->error("Offre introuvable pour la transaction ID {$transaction->id}");
                continue;
            }

            $compteStartup = CompteStartup::find($offre->compte_startup_id);
            if (!$compteStartup) {
                $this->error("Compte startup introuvable pour l'offre ID {$offre->id}");
                continue;
            }

            // Récupérer le compte admin
            $compteAdmin = CompteAdmin::first();
            if (!$compteAdmin) {
                $this->error("Compte admin introuvable !");
                continue;
            }

            // Modifier le statut de l'offre
            $offre->statut = 'En cours';
            $offre->save();

            // Effectuer les opérations financières
            $compteInvestisseur->solde -= $montant;
            $compteInvestisseur->save();

            $compteAdmin->solde += $montantAdmin;
            $compteAdmin->save();

            $compteStartup->solde += $montantStartup;
            $compteStartup->save();

            // Marquer la transaction comme traitée
            $transaction->statut = 'Traitée';
            $transaction->save();

            // Création des lignes dans la tables remboursements

            // Variables nécessaires pour les calculs
            $capitalRestant = $montantStartup; // Montant total de l'investissement
            $tauxInteret = $offre->taux_interet; // Taux d'intérêt en pourcentage
            $duree = $offre->nbre_mois_remboursement; // Nombre de mois de remboursement
            $delaiGrace = $offre->nbre_mois_grace; // Délai de grâce en mois
            $capitalTotalRestant = $capitalRestant; // Pour fixer le capital total restant après la période de grâce
            $cumulRemboursement = 0;

            $currentMonth = now()->month;  // Mois actuel
            $currentYear = now()->year;    // Année actuelle

            // Parcours pour chaque mois (grâce + remboursement)
            for ($i = 1; $i <= $duree + $delaiGrace; $i++) {
                // Calcul du mois suivant
                $monthIndex = ($currentMonth + $i) % 12;
                if ($monthIndex == 0) $monthIndex = 12; // Ajuster pour janvier (1er mois)

                // Incrémentation de l'année après chaque 12 mois
                $yearOffset = intdiv(($currentMonth + $i - 1), 12);
                $year = $currentYear + $yearOffset;

                // Format du mois et de l'année
                $mois = now()->setMonth($monthIndex)->translatedFormat('F') . " " . $year;

                $remboursementCapital = 0;
                $remboursementInteret = 0;
                $interetDu = 0;

                // Calcul des intérêts pendant la période de grâce
                if ($i <= $delaiGrace) {
                    $interetDu = floor($capitalRestant * ($tauxInteret / 100));
                    $capitalRestant += $interetDu; // Ajouter les intérêts au capital restant
                }

                // Calcul des remboursements après la période de grâce
                if ($i > $delaiGrace) {
                    if ($i == $delaiGrace + 1) {
                        $capitalTotalRestant = $capitalRestant; // Fixer le capital total à rembourser
                    }

                    $remboursementCapital = floor($capitalTotalRestant / $duree);
                    $remboursementInteret = floor($capitalRestant * ($tauxInteret / 100));
                    $capitalRestant -= $remboursementCapital; // Mise à jour du capital restant
                }

                $remboursementTotal = $remboursementCapital + $remboursementInteret;
                $cumulRemboursement += $remboursementTotal;

                // Créer l'entrée dans la table remboursements
                Remboursement::create([
                    'offre_id' => $offre->id,
                    'compte_startup_id' => $offre->compte_startup_id,
                    'compte_investisseur_id' => $offre->compte_investisseur_id,
                    'mois' => $mois,
                    'capital_restant' => max(0, $capitalRestant),
                    'interet_du' => $interetDu,
                    'remboursement_capital' => $remboursementCapital,
                    'remboursement_interet' => $remboursementInteret,
                    'remboursement_total' => $remboursementTotal,
                    'cumul_remboursement' => $cumulRemboursement,
                ]);
            }
            // Envoyer l'email à l'investisseur
            Mail::to($compteInvestisseur->email)->send(new NotificationInvestisseur($transaction, $compteInvestisseur));

            // Envoyer l'email à la startup
            Mail::to($compteStartup->email)->send(new NotificationStartup($transaction, $compteInvestisseur, $compteStartup));

            $this->info("Transaction ID {$transaction->id} traitée avec succès.");
        }

        $this->info('Traitement des transactions terminé.');
        return Command::SUCCESS;
    }
}
