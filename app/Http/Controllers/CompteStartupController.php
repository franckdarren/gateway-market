<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompteStartup;
use Illuminate\Support\Facades\Auth;

class CompteStartupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Affiche la liste des comptes startup
        $comptes = CompteStartup::all();
        return view('compte-startup.index', compact('comptes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Affiche le formulaire de création
        return view('compte-startup.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Vérifie si l'utilisateur a déjà un compte startup
        if (Auth::user()->compteStartup) {
            return redirect()->route('comptes.index')->with('error', 'Vous avez déjà un compte startup.');
        }

        // Valider les données d'entrée
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'date_creation' => 'required|date',
            'activite_principale' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:compte_startups,email',
            'phone' => 'required|string|max:20',
        ]);


        // Créer un nouveau compte startup pour l'utilisateur
        $compteStartup = CompteStartup::create([
            'nom' => $validatedData['nom'],
            'date_creation' => $validatedData['date_creation'],
            'activite_principale' => $validatedData['activite_principale'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'user_id' => Auth::id(),
            'solde' => 0, // Initialise le solde par défaut
        ]);

        return redirect()->route('dashboard')->with('success', 'Compte startup créé avec succès.');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer le compte startup par son ID
        $compte = CompteStartup::findOrFail($id);

        // Vérifier que le compte appartient bien à l'utilisateur connecté
        if ($compte->user_id !== auth()->id()) {
            // Si ce n'est pas le compte de l'utilisateur connecté, redirige-le avec un message d'erreur
            return redirect()->route('comptes.index')->with('error', 'Vous n\'êtes pas autorisé à voir ce compte.');
        }

        // Afficher le compte startup
        return view('compte-startup.show', compact('compte'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupérer le compte startup par son ID
        $compte = CompteStartup::findOrFail($id);

        // Vérifier que le compte appartient bien à l'utilisateur connecté
        if ($compte->user_id !== auth()->id()) {
            // Si ce n'est pas le compte de l'utilisateur connecté, redirige-le avec un message d'erreur
            return redirect()->route('comptes.index')->with('error', 'Vous n\'êtes pas autorisé à modifier ce compte.');
        }

        // Afficher le formulaire d'édition avec les données du compte
        return view('compte-startup.edit', compact('compte'));
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

        // Vérifier que le compte appartient bien à l'utilisateur connecté
        if ($compte->user_id !== auth()->id()) {
            // Si ce n'est pas le compte de l'utilisateur connecté, redirige-le avec un message d'erreur
            return redirect()->route('comptes.index')->with('error', 'Vous n\'êtes pas autorisé à modifier ce compte.');
        }

        // Mettre à jour uniquement les champs spécifiés
        $compte->activite_principale = $request->input('activite_principale');
        $compte->email = $request->input('email');
        $compte->phone = $request->input('phone');

        // Enregistrer les modifications
        $compte->save();

        // Rediriger avec un message de succès
        return redirect()->route('compte-startup.index')->with('success', 'Compte startup mis à jour avec succès.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupérer le compte startup par son ID
        $compte = CompteStartup::findOrFail($id);

        // Vérifier que le compte appartient bien à l'utilisateur connecté
        if ($compte->user_id !== auth()->id()) {
            // Si ce n'est pas le compte de l'utilisateur connecté, redirige-le avec un message d'erreur
            return redirect()->route('compte-startup.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer ce compte.');
        }

        // Supprimer le compte
        $compte->delete();

        // Rediriger avec un message de succès
        return redirect()->route('compte-startup.index')->with('success', 'Compte startup supprimé avec succès.');
    }
}
