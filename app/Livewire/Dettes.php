<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Remboursement;

class Dettes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $compte = auth()->user()->compteStartup;
        $remboursements = Remboursement::where('compte_startup_id', $compte->id)->paginate(12);

        return view('livewire.dettes', [
            'remboursements' => $remboursements,
        ]);
    }
}
