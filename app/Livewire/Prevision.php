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

        // Mois de départ pour les remboursements (un mois après le mois actuel)
        $currentMonth = now()->addMonth()->month; // Décalage d'un mois
        $currentYear = now()->addMonth()->year;

        // Calcul des mensualités en tenant compte du délai de grâce
        for ($i = 1; $i <= $this->duree + $this->delaiGrace; $i++) {
            $monthIndex = ($currentMonth + $i - 1) % 12 ?: 12; // Récupère le mois entre 1 et 12
            $yearOffset = intdiv($currentMonth + $i - 1, 12); // Ajuste l'année si on dépasse décembre

            $monthName = now()->setMonth($monthIndex)->translatedFormat('F'); // Récupère le nom du mois
            $year = $currentYear + $yearOffset; // Calcule l'année correspondante

            if ($i <= $this->delaiGrace) {
                // Pendant le délai de grâce, on ne paye rien
                $remboursements[] = [
                    'mois' => $monthName . ' ' . $year,
                    'montant' => 0, // Pas de remboursement pendant le délai de grâce
                ];
            } else {
                // Après le délai de grâce, on commence à rembourser
                $remboursements[] = [
                    'mois' => $monthName . ' ' . $year,
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
