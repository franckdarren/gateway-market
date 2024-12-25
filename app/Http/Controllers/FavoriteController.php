<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request, Offre $offre)
    {
        $compteInvestisseur = auth()->user()->compteInvestisseur;

        if (!$compteInvestisseur) {
            return response()->json(['error' => 'Vous devez avoir un compte investisseur.'], 403);
        }

        if ($compteInvestisseur->favorites()->where('offre_id', $offre->id)->exists()) {
            $compteInvestisseur->favorites()->detach($offre->id);
            return response()->json(['message' => 'Offre retirée des favoris.']);
        } else {
            $compteInvestisseur->favorites()->attach($offre->id);
            return response()->json(['message' => 'Offre ajoutée aux favoris.']);
        }
    }

    public function listFavorites()
    {
        $compteInvestisseur = auth()->user()->compteInvestisseur;

        if (!$compteInvestisseur) {
            return response()->json(['error' => 'Vous devez avoir un compte investisseur.'], 403);
        }

        $favorites = $compteInvestisseur->favorites()->with('offres')->get();
        return response()->json($favorites);
    }
}
