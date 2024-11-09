<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompteInvestisseur;

class CompteInvestisseurController extends Controller
{
    // Afficher la liste des comptes investisseurs
    public function index()
    {
        $comptes = CompteInvestisseur::all();
        return view('compte-investisseur.index', compact('comptes'));
    }

    // Afficher le formulaire pour créer un nouveau compte investisseur
    public function create()
    {
        return view('compte-investisseur.create');
    }

    // Enregistrer un nouveau compte investisseur
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'ville' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'profession' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Créer un nouveau compte investisseur
        $compte = CompteInvestisseur::create($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('compte-investisseur.index')->with('success', 'Compte investisseur créé avec succès.');
    }

    // Afficher les détails d'un compte investisseur spécifique
    public function show(string $id)
    {
        // Récupérer le compte investisseur par son ID
        $compte = CompteInvestisseur::findOrFail($id);

        // Afficher les détails du compte
        return view('compte-investisseur.show', compact('compte'));
    }

    // Afficher le formulaire d'édition pour un compte investisseur spécifique
    public function edit(string $id)
    {
        // Récupérer le compte investisseur par son ID
        $compte = CompteInvestisseur::findOrFail($id);

        // Afficher le formulaire d'édition avec les données du compte
        return view('compte-investisseur.edit', compact('compte'));
    }

    // Mettre à jour un compte investisseur spécifique
    public function update(Request $request, string $id)
    {
        // Valider les données à mettre à jour
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'ville' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'profession' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Récupérer le compte investisseur par son ID
        $compte = CompteInvestisseur::findOrFail($id);

        // Mettre à jour les données du compte
        $compte->update($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('compte-investisseur.index')->with('success', 'Compte investisseur mis à jour avec succès.');
    }

    // Supprimer un compte investisseur spécifique
    public function destroy(string $id)
    {
        // Récupérer le compte investisseur par son ID
        $compte = CompteInvestisseur::findOrFail($id);

        // Supprimer le compte investisseur
        $compte->delete();

        // Rediriger avec un message de succès
        return redirect()->route('compte-investisseur.index')->with('success', 'Compte investisseur supprimé avec succès.');
    }
}
