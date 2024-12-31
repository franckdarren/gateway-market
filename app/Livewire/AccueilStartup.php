<?php

namespace App\Livewire;

use App\Models\Offre;
use Livewire\Component;

class AccueilStartup extends Component
{
    public $mesOffres = [];
    public $mesOffresEnCours = [];
    public $compteStartupId = null;
    public $hasCompteStartup = false;

    public function mount()
    {
        // Vérifie si l'utilisateur a un compte startup
        $user = auth()->user();
        if ($user && $user->compteStartup) {
            $this->compteStartupId = $user->compteStartup->id;
            $this->hasCompteStartup = true;
            $this->mesOffres = Offre::where('compte_startup_id', $this->compteStartupId)
                ->orderBy('created_at', 'desc')
                ->get();

            $this->mesOffresEnCours = Offre::where('compte_startup_id', $this->compteStartupId)
                ->where('statut', 'En cours')
                ->with(['compteInvestisseur', 'rsi'])
                ->get();

            // Calculer la somme des paiements déjà effectués pour chaque offre
            $this->mesOffresEnCours->each(function ($offre) {
                $offre->sommeRemboursementsEffectues = $offre->sommeRemboursementsEffectues();
                $offre->pourcentageRemboursement = $offre->pourcentageRemboursement();
            });
        } else {
            $this->hasCompteStartup = false;
        }
    }

    public function render()
    {
        return view('livewire.accueil-startup', [
            'mesOffres' => $this->mesOffres,
            'mesOffresEnCours' => $this->mesOffresEnCours,
            'hasCompteStartup' => $this->hasCompteStartup,
        ]);
    }
}
