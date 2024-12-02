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
        $mesOffres = Offre::select('offres.*')
            ->join('compte_startups', 'offres.compte_startup_id', '=', 'compte_startups.id')
            ->join('users', 'compte_startups.user_id', '=', 'users.id')
            ->where('offres.statut', 'Disponible')
            ->orderByRaw("CASE WHEN users.type_abonnement = 'Premium' THEN 0 ELSE 1 END")
            ->orderBy('offres.created_at', 'desc')
            ->paginate(12); // 25 offres par page

        return view('livewire.investisseur', [
            'mesOffres' => $mesOffres,
        ]);
    }
}
