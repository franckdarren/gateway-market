<?php

namespace App\Livewire;

use App\Models\Offre;
use Livewire\Component;
use App\Models\CompteStartup;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class OffreForm extends Component
{
    use WithFileUploads;

    public $nom_projet;
    public $description_projet;
    public $montant;
    public $nbre_mois_remboursement;
    public $delaiGrace;
    public $tauxInteret;
    public $url_business_plan;
    public $url_etude_risque;
    public $van;
    public $ir;
    public $tri;
    public $krl;
    public $remboursements = [];

    protected $rules = [
        'nom_projet' => 'required|string|max:255',
        'description_projet' => 'required|string',
        'montant' => 'required|numeric|min:0',
        'nbre_mois_remboursement' => 'required|integer|min:1',
        'delaiGrace' => 'required|integer|min:0',
        'tauxInteret' => 'required|in:3,6,9,12,15,18,21',
        'url_business_plan' => 'nullable|file|mimes:pdf', // 10MB max
        'url_etude_risque' => 'nullable|file|mimes:pdf', // 10MB max
        'van' => 'required|numeric|min:0',
        'ir' => 'required|numeric|min:0',
        'tri' => 'required|numeric|min:0',
        'krl' => 'required|numeric|min:0',
    ];

    public function submit()
    {
        dd($this->url_business_plan, $this->url_etude_risque);

        $this->validate();

        // Vérifier si l'utilisateur a un compte startup
        $compteStartup = CompteStartup::where('user_id', auth()->id())->first();
        if (!$compteStartup) {
            return redirect()->back()->withErrors(['error' => 'Aucun compte startup associé à cet utilisateur.']);
        }

        // Store the uploaded files if they exist
        $businessPlanPath = $this->url_business_plan ? $this->url_business_plan->store('pdf/business_plans') : null;
        $etudeRisquePath = $this->url_etude_risque ? $this->url_etude_risque->store('pdf/etudes_risques') : null;

        // Create a new Offre
        Offre::create([
            'nom_projet' => $this->nom_projet,
            'description_projet' => $this->description_projet,
            'montant' => $this->montant,
            'nbre_mois_remboursement' => $this->nbre_mois_remboursement,
            'nbre_mois_grace' => $this->delaiGrace,
            'taux_interet' => $this->tauxInteret,
            'url_business_plan' => $businessPlanPath,
            'url_etude_risque' => $etudeRisquePath,
            'van' => $this->van,
            'ir' => $this->ir,
            'tri' => $this->tri,
            'krl' => $this->krl,
            'compte_startup_id' => $compteStartup->id,

        ]);

        session()->flash('message', 'Offre créée avec succès.');

        // Reset form fields
        $this->reset();

        // Optionally, redirect to another page
        return redirect()->route('dashboard')->with('success', 'Offre créée avec succès.');
    }

    public function updated($propertyName)
    {
        // dd($this->montant, $this->nbre_mois_remboursement, $this->delaiGrace, $this->tauxInteret);

        // Vérifiez si toutes les propriétés nécessaires sont remplies
        if ($this->montant && $this->nbre_mois_remboursement && $this->delaiGrace >= 0 && $this->tauxInteret) {
            // dd("calculatePrevisions");
            $this->calculatePrevisions();
        }
    }



    public function calculatePrevisions()
    {
        // Vérification des champs pour éviter les calculs incorrects
        if (!$this->montant || !$this->nbre_mois_remboursement || !$this->tauxInteret) {
            return;
        }

        $remboursements = [];
        $cumulRemboursement = 0;
        $capitalRestant = $this->montant;
        $capitalTotalRestant = $capitalRestant;
        $interetDu = 0;

        // Récupérer le mois, l'année et le jour de départ
        $currentMonth = now()->month;  // Mois actuel
        $currentYear = now()->year;    // Année actuelle
        $currentDay = now()->day;      // Jour actuel

        for ($i = 1; $i <= $this->nbre_mois_remboursement + $this->delaiGrace; $i++) {
            $monthIndex = ($currentMonth + $i) % 12;
            if ($monthIndex == 0) $monthIndex = 12; // Ajuster pour janvier (1er mois)

            $yearOffset = intdiv(($currentMonth + $i - 1), 12); // Incrémenter l'année après 12 mois
            $year = $currentYear + $yearOffset;

            // Calculer le jour du mois à afficher
            $date = now()->setMonth($monthIndex)->setYear($year)->day($currentDay); // Utilisation du jour actuel
            $monthNameWithDay = $date->translatedFormat('d F Y'); // Format : "Jour Mois Année"

            $remboursementCapital = 0;
            $remboursementInteret = 0;

            if ($i <= $this->delaiGrace) {
                $interetDu = floor($capitalRestant * ($this->tauxInteret / 100));
                $capitalRestant += $interetDu;
            }

            if ($i > $this->delaiGrace) {
                if ($i == $this->delaiGrace + 1) {
                    $capitalTotalRestant = $capitalRestant;
                }

                $remboursementCapital = floor($capitalTotalRestant / $this->nbre_mois_remboursement);
                $remboursementInteret = floor($capitalRestant * ($this->tauxInteret / 100));
                $capitalRestant -= $remboursementCapital;
            }

            $remboursementTotal = $remboursementCapital + $remboursementInteret;
            $cumulRemboursement += $remboursementTotal;

            // Ajouter le jour actuel dans le format mois jour année
            $remboursements[] = [
                'mois' => $monthNameWithDay,
                'capital_restant' => (int) max(0, $capitalRestant),
                'interet_du' => (int) ($i <= $this->delaiGrace ? $interetDu : 0),
                'remboursement_capital' => (int) $remboursementCapital,
                'remboursement_interet' => (int) $remboursementInteret,
                'remboursement_total' => (int) $remboursementTotal,
                'cumul_remboursement' => (int) $cumulRemboursement,
            ];
        }

        $this->remboursements = $remboursements;
    }


    public function render()
    {
        // Exécutez calculatePrevisions au chargement initial si les champs sont déjà remplis
        if ($this->montant && $this->nbre_mois_remboursement && $this->delaiGrace && $this->tauxInteret) {
            $this->calculatePrevisions();
        }

        return view('livewire.offre-form', [
            'remboursements' => $this->remboursements,
        ]);
    }
}
