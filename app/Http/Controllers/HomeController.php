<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user && $user->compteStartup) {
            $compteStartupId = $user->compteStartup->id;
            $mesOffres = Offre::where('compte_startup_id', $compteStartupId)->count();
        } elseif ($user && $user->compteInvestisseur) {
            $mesOffres = Offre::select('offres.*')
                ->join('compte_startups', 'offres.compte_startup_id', '=', 'compte_startups.id')
                ->join('users', 'compte_startups.user_id', '=', 'users.id')
                ->where('offres.statut', 'Disponible')
                ->count();
        } else {
            $mesOffres = 0;
        }

        return view('dashboard', [
            'mesOffres' => $mesOffres,
        ]);
    }
}
