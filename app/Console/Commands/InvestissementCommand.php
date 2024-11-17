<?php

namespace App\Console\Commands;

use App\Models\Offre;
use App\Models\CompteAdmin;
use App\Models\Transaction;
use App\Models\CompteStartup;
use Illuminate\Console\Command;
use App\Models\CompteInvestisseur;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationInvestisseur;

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
            $montantAdmin = $montant * 0.02; // 2%
            $montantStartup = $montant * 0.98; // 98%

            // Récupérer le compte investisseur
            $compteInvestisseur = CompteInvestisseur::find($transaction->compte_id);
            if (!$compteInvestisseur) {
                $this->error("Compte investisseur introuvable pour la transaction ID {$transaction->id}");
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

            // Envoyer l'email à l'investisseur
            Mail::to($compteInvestisseur->email)->send(new NotificationInvestisseur($transaction, $compteInvestisseur));

            $this->info("Transaction ID {$transaction->id} traitée avec succès.");
        }

        $this->info('Traitement des transactions terminé.');
        return Command::SUCCESS;
    }
}
