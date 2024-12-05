<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class ProfilInvestisseur extends Component
{
    public $nom;
    public $prenom;
    public $pays;
    public $etat_province;
    public $ville;
    public $code_postal;
    public $phone;
    public $email;
    public $profession;

    public function mount($investisseur)
    {

        $this->nom = $investisseur->nom;
        $this->prenom = $investisseur->prenom;
        $this->pays = $investisseur->pays;
        $this->etat_province = $investisseur->etat_province;
        $this->ville = $investisseur->ville;
        $this->code_postal = $investisseur->code_postal;
        $this->phone = $investisseur->phone;
        $this->email = $investisseur->email;
        $this->profession = $investisseur->profession;

    }

    public function render()
    {
        return view('livewire.profil-investisseur');
    }
}
