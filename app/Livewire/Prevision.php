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

    public function updated($propertyName)
    {
        $this->calculatePrevisions();
    }

    public function mount()
    {
        // Si vous avez besoin de valeurs par défaut pour certains champs,
        // vous pouvez les définir ici. Par exemple :
        $this->montantEmprunte;  // Exemple de valeur par défaut
        $this->duree;                // Exemple de valeur par défaut
        $this->tauxInteret;           // Exemple de valeur par défaut
        $this->delaiGrace;            // Exemple de valeur par défaut

        // Lancez le calcul des prévisions dès le montage du composant
        $this->calculatePrevisions();
    }

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
    $currentDay = now()->day;      // Jour actuel

    for ($i = 1; $i <= $this->duree + $this->delaiGrace; $i++) {
        $monthIndex = ($currentMonth + $i) % 12;
        if ($monthIndex == 0) $monthIndex = 12; // Ajuster pour janvier (1er mois)

        $yearOffset = intdiv(($currentMonth + $i - 1), 12); // Incrémenter l'année après 12 mois
        $year = $currentYear + $yearOffset;

        // Calculer le jour du mois à afficher
        $date = now()->setMonth($monthIndex)->setYear($year)->day($currentDay); // Utilisation du jour actuel
        $monthNameWithDay = $date->translatedFormat('d F Y'); // Format : "Jour Mois Année"

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
            'mois' => $monthNameWithDay,  // Affiche le jour actuel, le mois et l'année
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
