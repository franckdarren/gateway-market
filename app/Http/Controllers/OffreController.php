<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;
use App\Models\CompteStartup;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    // Afficher la liste des offres créées par l'utilisateur
    public function index()
    {
        // Récupérer les offres créées par l'utilisateur connecté
        $offres = Offre::whereHas('compte_startup', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('offre.index', compact('offres'));
    }

    // Afficher le formulaire pour créer une nouvelle offre
    public function create()
    {
        // Récupérer les startups créées par l'utilisateur connecté
        $startups = CompteStartup::where('user_id', Auth::id())->get();

        return view('offre.create', compact('startups'));
    }

    // Enregistrer une nouvelle offre
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'nom_projet' => 'required|string|max:255',
            'description_projet' => 'required|string',
            'montant' => 'required|integer',
            'nbre_mois_remboursement' => 'required|integer',
            'nbre_mois_grace' => 'required|integer',
            'taux_interet' => 'required|integer',
            'url_business_plan' => 'nullable|url',
            'url_etude_risque' => 'nullable|url',
            'van' => 'required|integer',
            'ir' => 'required|numeric',
            'tri' => 'required|numeric',
            'krl' => 'required|numeric',
            'compte_startup_id' => 'required|exists:compte_startups,id',
        ]);

        // Créer une nouvelle offre
        $offre = Offre::create([
            'nom_projet' => $request->nom_projet,
            'description_projet' => $request->description_projet,
            'montant' => $request->montant,
            'nbre_mois_remboursement' => $request->nbre_mois_remboursement,
            'nbre_mois_grace' => $request->nbre_mois_grace,
            'taux_interet' => $request->taux_interet,
            'url_business_plan' => $request->url_business_plan,
            'url_etude_risque' => $request->url_etude_risque,
            'van' => $request->van,
            'ir' => $request->ir,
            'tri' => $request->tri,
            'krl' => $request->krl,
            'compte_startup_id' => $request->compte_startup_id,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('offre.index')->with('success', 'Offre créée avec succès.');
    }

    // Afficher les détails d'une offre spécifique
    public function show(string $id)
    {
        // Récupérer l'offre par son ID
        $offre = Offre::findOrFail($id);

        // Afficher les détails de l'offre
        return view('offre.show', compact('offre'));
    }

    // Afficher le formulaire d'édition pour une offre spécifique
    public function edit(string $id)
    {
        // Récupérer l'offre par son ID
        $offre = Offre::findOrFail($id);

        // Récupérer les startups créées par l'utilisateur connecté
        $startups = CompteStartup::where('user_id', Auth::id())->get();

        return view('offre.edit', compact('offre', 'startups'));
    }

    // Mettre à jour une offre spécifique
    public function update(Request $request, string $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'nom_projet' => 'required|string|max:255',
            'description_projet' => 'required|string',
            'montant' => 'required|integer',
            'nbre_mois_remboursement' => 'required|integer',
            'nbre_mois_grace' => 'required|integer',
            'taux_interet' => 'required|integer',
            'url_business_plan' => 'nullable|url',
            'url_etude_risque' => 'nullable|url',
            'van' => 'required|integer',
            'ir' => 'required|numeric',
            'tri' => 'required|numeric',
            'krl' => 'required|numeric',
            'compte_startup_id' => 'required|exists:compte_startups,id',
        ]);

        // Récupérer l'offre par son ID
        $offre = Offre::findOrFail($id);

        // Mettre à jour les données de l'offre
        $offre->update([
            'nom_projet' => $request->nom_projet,
            'description_projet' => $request->description_projet,
            'montant' => $request->montant,
            'nbre_mois_remboursement' => $request->nbre_mois_remboursement,
            'nbre_mois_grace' => $request->nbre_mois_grace,
            'taux_interet' => $request->taux_interet,
            'url_business_plan' => $request->url_business_plan,
            'url_etude_risque' => $request->url_etude_risque,
            'van' => $request->van,
            'ir' => $request->ir,
            'tri' => $request->tri,
            'krl' => $request->krl,
            'compte_startup_id' => $request->compte_startup_id,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('offre.index')->with('success', 'Offre mise à jour avec succès.');
    }

    // Supprimer une offre spécifique
    public function destroy(string $id)
    {
        // Récupérer l'offre par son ID
        $offre = Offre::findOrFail($id);

        // Supprimer l'offre
        $offre->delete();

        // Rediriger avec un message de succès
        return redirect()->route('offre.index')->with('success', 'Offre supprimée avec succès.');
    }
}
