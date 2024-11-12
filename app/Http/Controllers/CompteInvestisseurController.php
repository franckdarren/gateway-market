<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        // Récupère les utilisateurs ayant le rôle 'Investisseur'
        $investisseurUser = User::role('Investisseur')->first();

        // Vérifie s'il existe un investisseur
        if ($investisseurUser && !$investisseurUser->compteInvestisseur) {
            return view('compte-investisseur.create', compact('investisseurUser'));
        } else {
            return redirect()->route('compte-investisseur.index')->with('error', "L'utilisateur a déjà un compte investisseur.");
        }
    }

    // Enregistrer un nouveau compte investisseur
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'profession' => 'required|string|max:255',
        ]);

        // Récupérer l'utilisateur investisseur
        $investisseurUser = User::role('investisseur')->first();

        // Créer le compte investisseur
        $compteInvestisseur = new CompteInvestisseur($request->all());
        $compteInvestisseur->user_id = $investisseurUser->id;

        $compteInvestisseur->save();

        return redirect()->route('compte-investisseur.index')->with('success', 'Compte investisseur créé avec succès.');
    }

    // Afficher les détails d'un compte investisseur spécifique
    public function show(string $id)
    {
        // Récupérer le compte investisseur par son ID
        $compte = CompteInvestisseur::findOrFail($id);

        // Vérifier que le compte appartient à l'utilisateur connecté et a le rôle 'Investisseur'
        if ($compte->user_id !== auth()->id() || !auth()->user()->hasRole('Investisseur')) {
            abort(403, 'Accès non autorisé.');
        }

        // Afficher les détails du compte
        return view('compte-investisseur.show', compact('compte'));
    }


    // Afficher le formulaire d'édition pour un compte investisseur spécifique
    public function edit($id)
    {
        $compteInvestisseur = CompteInvestisseur::findOrFail($id);
        return view('compte-investisseur.edit', compact('compteInvestisseur'));
    }

    // Mettre à jour un compte investisseur spécifique
    public function update(Request $request, $id)
    {
        $compteInvestisseur = CompteInvestisseur::findOrFail($id);

        $compteInvestisseur->update($request->all());

        return redirect()->route('compte-investisseur.index')->with('success', 'Compte investisseur mis à jour avec succès.');
    }

    // Supprimer un compte investisseur spécifique
    public function destroy($id)
    {
        $compteInvestisseur = CompteInvestisseur::findOrFail($id);
        $compteInvestisseur->delete();

        return redirect()->route('compte-investisseur.index')->with('success', 'Compte investisseur supprimé avec succès.');
    }
}
