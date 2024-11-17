<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class ProfilStartup extends Component
{
    public $nom;
    public $activite_principale;
    public $email;
    public $phone;
    public $date_creation;

    protected $rules = [
        'activite_principale' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
    ];

    public function mount($startup)
    {
        $this->nom = $startup->nom;
        $this->activite_principale = $startup->activite_principale;
        $this->email = $startup->email;
        $this->phone = $startup->phone;
        $this->date_creation = Carbon::parse($startup->date_creation)->format('d-M-Y');
    }

    public function updateCompteInformation()
    {
        $this->validate();

        $startup = auth()->user()->compteStartup;
        $startup->update([
            'activite_principale' => $this->activite_principale,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        session()->flash('success', 'Compte mis à jour avec succès !');
    }

    public function render()
    {
        return view('livewire.profil-startup');
    }
}
