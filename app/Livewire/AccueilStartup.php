<?php

namespace App\Livewire;

use App\Models\Offre;
use Livewire\Component;

class AccueilStartup extends Component
{
    public $mesOffres = [];
    public $compteStartupId = null;
    public $hasCompteStartup = false;

    public function mount()
    {
        // Vérifie si l'utilisateur a un compte startup
        $user = auth()->user();
        if ($user && $user->compteStartup) {
            $this->compteStartupId = $user->compteStartup->id;
            $this->hasCompteStartup = true;
            $this->mesOffres = Offre::where('compte_startup_id', $this->compteStartupId)->orderBy('created_at', 'desc')->get();
        } else {
            $this->hasCompteStartup = false;
        }
    }

    public function render()
    {
        return view('livewire.accueil-startup', [
            'mesOffres' => $this->mesOffres,
            'hasCompteStartup' => $this->hasCompteStartup,
        ]);
    }
}
