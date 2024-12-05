<?php

namespace App\Livewire;

use App\Models\Offre;
use Livewire\Component;
use Livewire\WithPagination;

class Projets extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public function render()
    {
        $compte = auth()->user()->compteInvestisseur;
        $mesOffres = Offre::where('compte_investisseur_id', $compte->id)
            ->where(function ($query) {
                // Inclure les offres sans remboursements
                $query->doesntHave('remboursements')
                    // Inclure les offres avec au moins un remboursement non "Remboursé"
                    ->orWhereHas('remboursements', function ($subQuery) {
                        $subQuery->where('statut', '!=', 'Remboursé');
                    });
            })
            ->paginate(12);
        return view('livewire.projets', [
            'mesOffres' => $mesOffres,
        ]);
    }
}
