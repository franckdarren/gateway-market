<?php

namespace App\Livewire;

use App\Models\CompteInvestisseur;
use App\Models\CompteStartup;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class DashboardAdmin extends Component
{
    public $utilisateurs;
    public $compteStatup;
    public $compteInvestisseur;
    public $attenteRetrait;


    public function render()
    {
        // Rafraîchir les données à chaque requête
        $this->utilisateurs = User::count();
        $this->compteStatup = CompteStartup::count();
        $this->compteInvestisseur = CompteInvestisseur::count();
        $this->attenteRetrait = Transaction::where('statut', 'En attente de traitement')->count();

        return view('livewire.dashboard-admin', [
            'utilisateurs' => $this->utilisateurs,
            'compteStatup' => $this->compteStatup,
            'compteInvestisseur' => $this->compteInvestisseur,
            'attenteRetrait' => $this->attenteRetrait,

        ]);
    }
}
