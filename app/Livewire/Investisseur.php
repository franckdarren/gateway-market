<?php

namespace App\Livewire;

use App\Models\Offre;
use Livewire\Component;
use Livewire\WithPagination;

class Investisseur extends Component
{
    use WithPagination; // Importer le trait pour la pagination

    public $compteInvestisseurId = null;
    public $hasCompteInvestisseur = false;
    // Personnalisation du nombre d'éléments par page
    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        // Vérifie si l'utilisateur a un compte startup
        $user = auth()->user();
        if ($user && $user->compteInvestisseur) {
            $this->compteInvestisseurId = $user->compteInvestisseur->id;
            $this->hasCompteInvestisseur = true;
        } else {
            $this->hasCompteInvestisseur = false;
        }
    }

    public function render()
    {
        // Paginer les offres au lieu de tout charger
        $mesOffres = Offre::where('statut', 'Disponible')->paginate(12); // 25 offres par page

        return view('livewire.investisseur', [
            'mesOffres' => $mesOffres,
        ]);
    }
}
