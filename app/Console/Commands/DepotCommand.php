<?php

namespace App\Console\Commands;

use App\Models\CompteAdmin;
use App\Models\Transaction;
use App\Models\CompteStartup;
use App\Mail\NotificationDepot;
use Illuminate\Console\Command;
use App\Models\CompteInvestisseur;
use Illuminate\Support\Facades\Mail;

class DepotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'depot:command';

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
        $this->info('Début du traitement des transactions de type depot...');

        // Récupérer toutes les transactions "investissement" non traitées
        $retraits = Transaction::where('type', 'depot')
            ->where('statut', 'En attente de traitement')
            ->get();

        if ($retraits->isEmpty()) {
            $this->info('Aucune transaction de type depot à traiter.');
            return Command::SUCCESS;
        }

        foreach ($retraits as $transaction) {
            $this->info("Traitement de la transaction ID {$transaction->id}...");

            $montant = $transaction->montant;

            // Récupérer le compte
            if ($transaction->compte_type === "Compte Investisseur") {
                $compte = CompteInvestisseur::find($transaction->compte_id);
            } elseif ($transaction->compte_type === "Compte Admin") {
                $compte = CompteAdmin::find($transaction->compte_id);
            } elseif ($transaction->compte_type === "Compte Startup") {
                $compte = CompteStartup::find($transaction->compte_id);
            }


            // Récupérer le compte admin
            $compteAdmin = CompteAdmin::first();

            // Effectuer les opérations financières
            $compte->solde += $montant;
            $compte->save();

            // Marquer la transaction comme traitée
            $transaction->statut = 'Traitée';
            $transaction->save();

            // Envoyer l'email au compte
            Mail::to($compte->email)->send(new NotificationDepot($transaction));

            $this->info("Transaction ID {$transaction->id} traitée avec succès.");
        }

        $this->info('Traitement des transactions terminé.');
        return Command::SUCCESS;
    }
}
