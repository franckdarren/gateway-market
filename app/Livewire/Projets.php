<?php

namespace App\Livewire;

use App\Models\Offre;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Remboursement;

class Projets extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public function render()
    {
        $compte = auth()->user()->compteInvestisseur;
        $mesOffres = Offre::where('compte_investisseur_id', $compte->id)
            ->where(function ($query) {
                $query->doesntHave('remboursements')
                    ->orWhereHas('remboursements', function ($subQuery) {
                        $subQuery->where('statut', '!=', 'Remboursé');
                    });
            })
            ->with(['compteStartup', 'rsi']) // Charger aussi la relation RSI
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Calculer la somme des paiements déjà effectués pour chaque offre
        $mesOffres->each(function ($offre) {
            $offre->sommeRemboursementsEffectues = $offre->sommeRemboursementsEffectues();
            $offre->pourcentageRemboursement = $offre->pourcentageRemboursement();
        });

        return view('livewire.projets', [
            'mesOffres' => $mesOffres,
        ]);
    }
}
