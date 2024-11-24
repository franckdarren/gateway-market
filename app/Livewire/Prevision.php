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
        $capitalRestant = $this->montantEmprunte; // Initialiser le capital restant avec le montant emprunté
        $capitalTotalRestant = $capitalRestant; // Sauvegarde pour ajuster après la période de grâce
        $interetDu = 0; // Initialiser l'intérêt dû

        $currentMonth = now()->addMonth()->month;
        $currentYear = now()->addMonth()->year;

        for ($i = 1; $i <= $this->duree + $this->delaiGrace; $i++) {
            $monthIndex = ($currentMonth + $i - 1) % 12 ?: 12;
            $yearOffset = intdiv($currentMonth + $i - 1, 12);
            $monthName = now()->setMonth($monthIndex)->translatedFormat('F');
            $year = $currentYear + $yearOffset;

            $remboursementCapital = 0;
            $remboursementInteret = 0;

            // Pendant la période de grâce, calcul de l'intérêt dû
            if ($i <= $this->delaiGrace) {
                $interetDu = floor($capitalRestant * ($this->tauxInteret / 100));
                $capitalRestant += $interetDu; // Ajouter les intérêts au capital restant
            }

            // Après la période de grâce
            if ($i > $this->delaiGrace) {
                // Si c'est le premier mois après la période de grâce, ajuster le capital total restant
                if ($i == $this->delaiGrace + 1) {
                    $capitalTotalRestant = $capitalRestant; // Le capital total à rembourser inclut tous les intérêts accumulés
                }

                // Calcul du remboursement du capital (fixe)
                $remboursementCapital = floor($capitalTotalRestant / $this->duree);

                // Calcul du remboursement des intérêts pour ce mois
                $remboursementInteret = floor($capitalRestant * ($this->tauxInteret / 100));

                // Mise à jour du capital restant après remboursement du capital
                $capitalRestant -= $remboursementCapital;
            }

            // Calcul du remboursement total (capital + intérêt)
            $remboursementTotal = $remboursementCapital + $remboursementInteret;

            // Cumul des remboursements
            $cumulRemboursement += $remboursementTotal;

            // Ajouter aux résultats
            $remboursements[] = [
                'mois' => "$monthName $year",
                'capital_restant' => (int) max(0, $capitalRestant), // Le capital restant ne doit pas être négatif
                'interet_du' => (int) ($i <= $this->delaiGrace ? $interetDu : 0), // L'intérêt dû uniquement pendant la période de grâce
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
