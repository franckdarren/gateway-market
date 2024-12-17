<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Remboursement;

class Remboursements extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public function render()
    {
        $compte = auth()->user()->compteInvestisseur;
        $remboursements = Remboursement::where('compte_investisseur_id', $compte->id)->paginate(12);
        return view('livewire.remboursements', [
            'remboursements' => $remboursements,
        ]);
    }
}
