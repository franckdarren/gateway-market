<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\CompteAdmin;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\CompteStartup;
use App\Models\CompteInvestisseur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        //

        // Valider les données du formulaire
        $request->validate([
            'nom_projet' => 'required|string|max:255',
            'description_projet' => 'required|string',
            'montant' => 'required|integer',
            'nbre_mois_grace' => 'required|integer',
            'taux_interet' => 'required|integer',
            'url_business_plan' => 'nullable|file|mimes:pdf|max:10240',
            'url_etude_risque' => 'nullable|file|mimes:pdf|max:10240',
            'van' => 'required|integer',
            'ir' => 'required|numeric',
            'tri' => 'required|numeric',
            'krl' => 'required|numeric',
        ]);
        // Gérer l'upload des fichiers PDF
        $businessPlanPath = null;
        $etudeRisquePath = null;

        if ($request->hasFile('url_business_plan')) {
            $businessPlanPath = $request->file('url_business_plan')->store('business_plans', 'public');
        }

        if ($request->hasFile('url_etude_risque')) {
            $etudeRisquePath = $request->file('url_etude_risque')->store('etudes_risques', 'public');
        }

        $compteStartup = CompteStartup::where('user_id', auth()->id())->first();
        $montantDette = $request->montant + $request->montant * $request->taux_interet / 100;

        // dd($montantDette);

        // Créer une nouvelle offre
        $offre = Offre::create([
            'nom_projet' => $request->nom_projet,
            'description_projet' => $request->description_projet,
            'montant' => $request->montant,
            'nbre_mois_remboursement' => $request->nbre_mois_remboursement,
            'nbre_mois_grace' => $request->nbre_mois_grace,
            'taux_interet' => $request->taux_interet,
            'montant_dette' => $montantDette,
            'url_business_plan' => $businessPlanPath,
            'url_etude_risque' => $etudeRisquePath,
            'van' => $request->van,
            'ir' => $request->ir,
            'tri' => $request->tri,
            'krl' => $request->krl,
            'compte_startup_id' => $compteStartup->id,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('dashboard')->with('success', 'Offre créée avec succès.');
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
        // Récupérer l'offre par son ID
        $offre = Offre::findOrFail($id);

        // Valider les données du formulaire
        $request->validate([
            'nom_projet' => 'required|string|max:255',
            'description_projet' => 'required|string',
            'montant' => 'required|numeric',
            'nbre_mois_remboursement' => 'required|integer',
            'nbre_mois_grace' => 'required|integer',
            'taux_interet' => 'required|integer',
            'url_business_plan' => 'nullable|file|mimes:pdf|max:10240',
            'url_etude_risque' => 'nullable|file|mimes:pdf|max:10240',
            'van' => 'required|numeric',
            'ir' => 'required|numeric',
            'tri' => 'required|numeric',
            'krl' => 'required|numeric',
        ]);

        // Vérifier si l'utilisateur a un compte startup
        $compteStartup = CompteStartup::where('user_id', auth()->id())->first();
        if (!$compteStartup) {
            return redirect()->back()->withErrors(['error' => 'Aucun compte startup associé à cet utilisateur.']);
        }

        // Calcul du montant de la dette
        $tauxInteret = $request->taux_interet / 100; // Convertir le pourcentage en fraction
        $montantDette = $request->montant + ($request->montant * $tauxInteret);

        // Gérer l'upload des fichiers PDF (Business Plan)
        if ($request->hasFile('url_business_plan')) {
            // Supprimer le fichier précédent si nécessaire
            if ($offre->url_business_plan) {
                Storage::disk('public')->delete($offre->url_business_plan);
            }
            // Enregistrer le nouveau fichier
            $offre->url_business_plan = $request->file('url_business_plan')->store('business_plans', 'public');
        }

        // Gérer l'upload des fichiers PDF (Étude de Risque)
        if ($request->hasFile('url_etude_risque')) {
            // Supprimer l'ancien fichier si nécessaire
            if ($offre->url_etude_risque) {
                Storage::disk('public')->delete($offre->url_etude_risque);
            }
            // Enregistrer le nouveau fichier
            $offre->url_etude_risque = $request->file('url_etude_risque')->store('etudes_risques', 'public');
        }

        // Mettre à jour les autres informations de l'offre
        $offre->nom_projet = $request->nom_projet;
        $offre->description_projet = $request->description_projet;
        $offre->montant = $request->montant;
        $offre->nbre_mois_remboursement = $request->nbre_mois_remboursement;
        $offre->nbre_mois_grace = $request->nbre_mois_grace;
        $offre->taux_interet = $request->taux_interet;
        $offre->montant_dette = $montantDette;
        $offre->van = $request->van;
        $offre->ir = $request->ir;
        $offre->tri = $request->tri;
        $offre->krl = $request->krl;
        $offre->compte_startup_id = $compteStartup->id;

        // Enregistrer toutes les modifications dans la base de données
        $offre->save();

        // Rediriger avec un message de succès
        return redirect()->route('dashboard')->with('success', 'Offre mise à jour avec succès.');
    }



    // Supprimer une offre spécifique
    public function destroy(string $id)
    {
        // Récupérer l'offre par son ID
        $offre = Offre::findOrFail($id);

        // Supprimer l'offre
        $offre->delete();

        // Rediriger avec un message de succès
        return redirect()->route('dashboard')->with('success', 'Offre supprimée avec succès.');
    }

    public function annuler(string $id)
    {
        // Récupérer l'offre par son ID
        $offre = Offre::findOrFail($id);

        // Vérifier si l'offre a le statut "En attente"
        if ($offre->statut === 'En attente') {
            // Réinitialiser l'offre
            $offre->statut = 'Disponible';
            $offre->compte_investisseur_id = null;

            // Enregistrer les modifications dans la base de données
            $offre->save();

            // Rediriger avec un message de succès
            return redirect()->route('projets')->with('success', 'L\'offre a été annulée avec succès.');
        }

        // Si le statut de l'offre n'est pas "En attente"
        return redirect()->route('projets')->with('error', 'Seules les offres en attente peuvent être annulées.');
    }


    public function investir(Offre $offre)
    {
        // Récupérer l'investisseur (utilisateur connecté)
        $investisseur = CompteInvestisseur::where('user_id', Auth::id())->first();

        if (!$investisseur) {
            // Si l'investisseur n'existe pas, retourner une erreur ou rediriger
            return redirect()->route('compte_investisseur.create')->with('error', 'Veuillez créer un compte investisseur.');
        }

        // Vérifier si le solde de l'investisseur est suffisant pour l'investissement + frais
        $montantInvestissement = $offre->montant;
        $frais = $montantInvestissement * 0.02;  // Calculer les 2% de l'offre
        $montantTotal = $montantInvestissement + $frais;

        if ($investisseur->solde < $montantTotal) {
            // Si le solde est insuffisant pour l'investissement + frais, retourner une erreur ou un message
            return redirect()->back()->with('error', 'Solde insuffisant pour cet investissement.');
        }

        Transaction::create([
            'montant' => $montantTotal,
            'type' => 'investissement',
            'description' => 'Investissement dans l\'offre ' . $offre->nom_projet,
            'compte_type' => 'CompteInvestisseur',
            'compte_id' => $investisseur->id,
            'offre_id' => $offre->id,
        ]);

        // Mettre à jour l'offre avec le compte investisseur et changer son statut
        $offre->compte_investisseur_id = $investisseur->id;
        $offre->statut = 'En attente'; // Vous pouvez définir un autre statut selon vos besoins
        $offre->save();

        // Retourner à la page de l'offre avec un message de succès
        return redirect()->route('offre.show', $offre->id)->with('success', 'Investissement en cours de traitement. Un email vous sera envoyé pour confirmer la transaction.');
    }
}
