<?php

namespace App\Livewire;

use Livewire\Component;

class Portefeuille extends Component
{
    public function render()
    {
        $totalRemboursements = auth()->user()->compteInvestisseur?->totalRemboursements() ?? 0;
        $totalInvestissement = auth()->user()->compteInvestisseur?->totalInvestissement() ?? 0;

        $benefice_perte = $totalRemboursements - $totalInvestissement;

        return view('livewire.portefeuille', [
            'totalRemboursements' => $totalRemboursements,
            'totalInvestissement' => $totalInvestissement,
            'benefice_perte' => $benefice_perte,
        ]);
    }
}
