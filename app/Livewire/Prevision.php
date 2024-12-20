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
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $currentDay = now()->day;

        // Ajouter une ligne initiale pour afficher le montant emprunté
        $remboursements[] = [
            'mois' => now()->translatedFormat('d F Y'), // Date actuelle
            'capital_restant' => (int) $capitalRestant,
            'interet_du' => 0,
            'remboursement_capital' => 0,
            'remboursement_interet' => 0,
            'remboursement_total' => 0,
            'cumul_remboursement' => 0,
        ];

        // Boucle pour les périodes suivantes
        for ($i = 1; $i <= $this->duree + $this->delaiGrace; $i++) {
            $monthIndex = ($currentMonth + $i - 1) % 12;
            if ($monthIndex == 0) $monthIndex = 12;

            $yearOffset = intdiv(($currentMonth + $i - 1), 12);
            $year = $currentYear + $yearOffset;

            $date = now()->setMonth($monthIndex)->setYear($year)->day($currentDay);
            $monthNameWithDay = $date->translatedFormat('d F Y');

            $remboursementCapital = 0;
            $remboursementInteret = 0;
            $capitalRestantDebutMois = $capitalRestant;

            // Phase de délai de grâce
            if ($i <= $this->delaiGrace) {
                $interetDu = floor($capitalRestantDebutMois * ($this->tauxInteret / 100));
                $capitalRestant += $interetDu; // Augmenter le capital restant des intérêts
            }

            // Phase de remboursement
            if ($i > $this->delaiGrace) {
                if ($i == $this->delaiGrace + 1) {
                    $capitalTotalRestant = $capitalRestant;
                }

                $remboursementCapital = floor($capitalTotalRestant / $this->duree);
                $remboursementInteret = floor($capitalRestantDebutMois * ($this->tauxInteret / 100));
                $capitalRestant -= $remboursementCapital; // Mise à jour du capital restant
            }

            $remboursementTotal = $remboursementCapital + $remboursementInteret;
            $cumulRemboursement += $remboursementTotal;

            $remboursements[] = [
                'mois' => $monthNameWithDay,
                'capital_restant' => (int) max(0, $capitalRestantDebutMois),
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
