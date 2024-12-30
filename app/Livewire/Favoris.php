<?php

namespace App\Livewire;

use Livewire\Component;

class Favoris extends Component
{
    protected $listeners = ['favoriteUpdated' => 'refreshFavoris'];

    public function render()
    {
        $investor = auth()->user()->compteInvestisseur;
        $favorites = $investor->favorites()->with(['compteStartup', 'rsi'])->get();

        return view('livewire.favoris', [
            'favorites' => $favorites,
        ]);
    }
}
