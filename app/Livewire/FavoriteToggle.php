<?php

namespace App\Livewire;

use App\Models\Offre;
use Livewire\Component;

class FavoriteToggle extends Component
{
    public $offre;
    public $isFavoris;

    public function mount(Offre $offre)
    {
        $this->offre = $offre;
        $this->isFavoris = $this->offre->isFavoris();
    }

    public function toggleFavorite()
    {
        $compteInvestisseur = auth()->user()->compteInvestisseur;

        if ($this->isFavoris) {
            $compteInvestisseur->favorites()->detach($this->offre->id);
            $this->isFavoris = false;
            session()->flash('success', 'Cette offre a été retirée dans la liste des favoris.');
        } else {
            $compteInvestisseur->favorites()->attach($this->offre->id);
            $this->isFavoris = true;
            session()->flash('success', 'Cette offre a été ajoutée de la liste des favoris.');
        }
    }

    public function render()
    {
        return view('livewire.favorite-toggle');
    }
}
