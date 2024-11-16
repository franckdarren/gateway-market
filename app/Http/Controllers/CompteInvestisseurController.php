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
        // Affiche le formulaire de création
        return view('compte-investisseur.create');
    }

    // Enregistrer un nouveau compte investisseur
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'etat_province' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:compte_investisseurs',
            'profession' => 'required|string|max:255',
        ]);

        // Création du compte investisseur
        $compteInvestisseur = CompteInvestisseur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'pays' => $request->pays,
            'etat_province' => $request->etat_province,
            'ville' => $request->ville,
            'code_postal' => $request->code_postal,
            'phone' => $request->phone,
            'email' => $request->email,
            'profession' => $request->profession,
            'solde' => 0,
            'user_id' => auth()->id(),  // Récupère l'id de l'utilisateur connecté
        ]);

        // Retourner une réponse, redirection, ou vue selon besoin
        return redirect()->route('compte_investisseur.index')->with('success', 'Compte créé avec succès!');
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
