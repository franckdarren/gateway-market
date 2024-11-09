<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompteStartup;

class CompteStartupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Affiche la liste des comptes startup
        $comptes = CompteStartup::all();
        return view('comptes.index', compact('comptes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Affiche le formulaire de création
        return view('comptes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Stocke un nouveau compte startup
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'date_creation' => 'required|date',
            'activite_principale' => 'required|string|max:255',
            'email' => 'required|email|unique:compte_startups,email',
            'phone' => 'required|string|max:15',
            'user_id' => 'nullable|exists:users,id',
        ]);

        CompteStartup::create($validatedData);

        return redirect()->route('comptes.index')->with('success', 'Compte startup créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer le compte startup par son ID
        $compte = CompteStartup::findOrFail($id);

        // Afficher le compte startup
        return view('comptes.show', compact('compte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupérer le compte startup par son ID
        $compte = CompteStartup::findOrFail($id);

        // Afficher le formulaire d'édition avec les données du compte
        return view('comptes.edit', compact('compte'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valider uniquement les champs à modifier
        $request->validate([
            'activite_principale' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Récupérer le compte startup par son ID
        $compte = CompteStartup::findOrFail($id);

        // Mettre à jour uniquement les champs spécifiés
        $compte->activite_principale = $request->input('activite_principale');
        $compte->email = $request->input('email');
        $compte->phone = $request->input('phone');

        // Enregistrer les modifications
        $compte->save();

        // Rediriger avec un message de succès
        return redirect()->route('comptes.index')->with('success', 'Compte startup mis à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupérer le compte startup par son ID
        $compte = CompteStartup::findOrFail($id);

        // Supprimer le compte
        $compte->delete();

        return redirect()->route('comptes.index')->with('success', 'Compte startup supprimé avec succès.');
    }
}
