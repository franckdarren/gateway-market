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
        $mesOffres = Offre::where('compte_investisseur_id', $compte->id)->paginate(12);
        return view('livewire.projets', [
            'mesOffres' => $mesOffres,
        ]);
    }
}
