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

        // Calcul du montant total à rembourser (y compris l'intérêt)
        $montantTotal = $this->montantEmprunte * (1 + ($this->tauxInteret / 100));

        // Calcul du montant de chaque mensualité (en excluant le délai de grâce)
        $mensualite = $montantTotal / $this->duree;

        // Initialisation du tableau des remboursements
        $remboursements = [];

        // Calcul des mensualités en tenant compte du délai de grâce
        for ($i = 1; $i <= $this->duree + $this->delaiGrace; $i++) {
            if ($i <= $this->delaiGrace) {
                // Pendant le délai de grâce, on ne paye rien
                $remboursements[] = [
                    'mois' => $i,
                    'montant' => 0, // Pas de remboursement pendant le délai de grâce
                ];
            } else {
                // Après le délai de grâce, on commence à rembourser
                $remboursements[] = [
                    'mois' => $i,
                    'montant' => round($mensualite, 2), // Arrondi pour plus de clarté
                ];
            }
        }

        // Stockage des remboursements calculés dans la propriété publique
        $this->remboursements = $remboursements;
    }

    public function render()
    {
        return view('livewire.prevision');
    }
}
