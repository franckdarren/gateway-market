<?php

namespace App\Livewire;

use App\Models\Offre;
use Livewire\Component;
use Livewire\WithPagination;

class Investisseur extends Component
{
    use WithPagination; // Importer le trait pour la pagination

    // Personnalisation du nombre d'éléments par page
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        // Paginer les offres au lieu de tout charger
        $mesOffres = Offre::paginate(12); // 25 offres par page

        return view('livewire.investisseur', [
            'mesOffres' => $mesOffres,
        ]);
    }
}
