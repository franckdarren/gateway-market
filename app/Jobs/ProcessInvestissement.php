<?php

namespace App\Jobs;

use App\Models\Remboursement;
use App\Mail\NotificationStartup;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationInvestisseur;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessInvestissement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $offre;
    protected $montantInvestissement;
    protected $investisseur;
    protected $startup;
    protected $transaction;


    /**
     * Create a new job instance.
     */
    public function __construct($offre, $montantInvestissement, $investisseur, $startup, $transaction)
    {
        $this->offre = $offre;
        $this->montantInvestissement = $montantInvestissement;
        $this->investisseur = $investisseur;
        $this->startup = $startup;
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $capitalRestant = $this->montantInvestissement;
        $tauxInteret = $this->offre->taux_interet;
        $duree = $this->offre->nbre_mois_remboursement;
        $delaiGrace = $this->offre->nbre_mois_grace;
        $capitalTotalRestant = $capitalRestant;
        $cumulRemboursement = 0;
        $currentDay = now()->day;

        for ($i = 1; $i <= $duree + $delaiGrace; $i++) {
            $date = now()->addMonths($i)->setDay(min($currentDay, now()->addMonths($i)->daysInMonth));
            $mois = $date->translatedFormat('d F Y');

            $remboursementCapital = 0;
            $remboursementInteret = 0;
            $interetDu = 0;

            if ($i <= $delaiGrace) {
                $interetDu = floor($capitalRestant * ($tauxInteret / 100));
                $capitalRestant += $interetDu;
            }

            if ($i > $delaiGrace) {
                if ($i == $delaiGrace + 1) {
                    $capitalTotalRestant = $capitalRestant;
                }

                $remboursementCapital = floor($capitalTotalRestant / $duree);
                $remboursementInteret = floor($capitalRestant * ($tauxInteret / 100));
                $capitalRestant -= $remboursementCapital;
            }

            $remboursementTotal = $remboursementCapital + $remboursementInteret;
            $cumulRemboursement += $remboursementTotal;

            Remboursement::create([
                'offre_id' => $this->offre->id,
                'compte_startup_id' => $this->offre->compte_startup_id,
                'compte_investisseur_id' => $this->offre->compte_investisseur_id,
                'mois' => $mois,
                'capital_restant' => max(0, $capitalRestant),
                'interet_du' => $interetDu,
                'remboursement_capital' => $remboursementCapital,
                'remboursement_interet' => $remboursementInteret,
                'remboursement_total' => $remboursementTotal,
                'cumul_remboursement' => $cumulRemboursement,
            ]);
        }

        Mail::to($this->investisseur->email)->send(new NotificationInvestisseur($this->transaction, $this->investisseur));
        Mail::to($this->startup->email)->send(new NotificationStartup($this->transaction, $this->investisseur, $this->startup));
    }
}
