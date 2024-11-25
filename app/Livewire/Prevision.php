<?php

namespace App\Livewire;

use Livewire\Component;

class Prevision extends Component
{
    public $montantEmprunte;
    public $duree;
    public $tauxInteret;
    public $delaiGrace;
    public $remboursements = [];



    public function calculatePrevisions()
    {
        // Vérification des champs pour éviter les calculs incorrects
        if (!$this->montantEmprunte || !$this->duree || !$this->tauxInteret) {
            return;
        }

        $remboursements = [];
        $cumulRemboursement = 0;
        $capitalRestant = $this->montantEmprunte;
        $capitalTotalRestant = $capitalRestant;
        $interetDu = 0;

        // Récupérer le mois et l'année de départ
        $currentMonth = now()->month;  // Mois actuel
        $currentYear = now()->year;    // Année actuelle

        for ($i = 1; $i <= $this->duree + $this->delaiGrace; $i++) {
            $monthIndex = ($currentMonth + $i) % 12;
            if ($monthIndex == 0) $monthIndex = 12; // Ajuster pour janvier (1er mois)

            $yearOffset = intdiv(($currentMonth + $i - 1), 12); // Incrémenter l'année après 12 mois
            $year = $currentYear + $yearOffset;

            $monthName = now()->setMonth($monthIndex)->translatedFormat('F');

            $remboursementCapital = 0;
            $remboursementInteret = 0;

            if ($i <= $this->delaiGrace) {
                $interetDu = floor($capitalRestant * ($this->tauxInteret / 100));
                $capitalRestant += $interetDu;
            }

            if ($i > $this->delaiGrace) {
                if ($i == $this->delaiGrace + 1) {
                    $capitalTotalRestant = $capitalRestant;
                }

                $remboursementCapital = floor($capitalTotalRestant / $this->duree);
                $remboursementInteret = floor($capitalRestant * ($this->tauxInteret / 100));
                $capitalRestant -= $remboursementCapital;
            }

            $remboursementTotal = $remboursementCapital + $remboursementInteret;
            $cumulRemboursement += $remboursementTotal;

            $remboursements[] = [
                'mois' => "$monthName $year",
                'capital_restant' => (int) max(0, $capitalRestant),
                'interet_du' => (int) ($i <= $this->delaiGrace ? $interetDu : 0),
                'remboursement_capital' => (int) $remboursementCapital,
                'remboursement_interet' => (int) $remboursementInteret,
                'remboursement_total' => (int) $remboursementTotal,
                'cumul_remboursement' => (int) $cumulRemboursement,
            ];
        }

        $this->remboursements = $remboursements;
    }



































    public function render()
    {
        return view('livewire.prevision');
    }
}
