<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CompteAdmin;
use App\Models\Transaction;
use App\Models\CompteStartup;
use App\Models\CompteInvestisseur;

class Retrait extends Component
{
    public $montant;
    public $type;
    public $description = "";
    public $mode_retrait;
    public $mode_depot;

    public $nom_compte;
    public $compte_id;
    public $compte_type;
    public $numero_compte;
    public $numero_transaction;

    protected $rules = [
        'montant' => 'required|numeric',
    ];

    public function submit()
    {
        // Récupérer l'utilisateur connecté
        $userRole = auth()->user()->getRoleNames()->first();
        $user = auth()->user();

        // Vérifier quel type de compte est associé à cet utilisateur
        if ($userRole === 'Administrateur') {
            // Si l'utilisateur a un CompteAdmin
            $compte_id = $user->compteAdmin->id;
            $compteType = 'Compte Admin';
            $compte = CompteAdmin::find($compte_id);
        } elseif ($userRole === 'Investisseur') {
            // Si l'utilisateur a un CompteInvestisseur
            $compte_id = $user->compteInvestisseur->id;
            $compteType = 'Compte Investisseur';
            $compte = CompteInvestisseur::find($compte_id);
        } elseif ($userRole === 'Startup') {
            // Si l'utilisateur a un CompteStartup
            $compte_id = $user->compteStartup->id;
            $compteType = 'Compte Startup';
            $compte = CompteStartup::find($compte_id);
        } else {
            // Si l'utilisateur n'a aucun compte valide
            session()->flash('error', 'Aucun compte valide trouvé pour l\'utilisateur.');
            return;
        }

        // Validation du numéro de compte en fonction du mode de retrait
        $rules = [
            'montant' => 'required|numeric',
            'type' => 'required|string',
            'nom_compte' => 'required|string',
            'numero_compte' => 'required|string',
        ];

        // Validation dynamique selon le mode de retrait
        if ($this->mode_retrait == 'AirtelMoney' || $this->mode_retrait == 'MoovMoney') {
            $rules['numero_compte'] = ['required', 'regex:/^\d{8,9}$/']; // Suite de 9 chiffres
        }
        // elseif ($this->mode_retrait == 'Virement') {
        //     $rules['numero_compte'] = ['required', 'regex:/^[A-Za-z0-9]{22}$/']; // Format RIB (22 caractères alphanumériques)
        // }

        // Applique la validation
        $this->validate($rules);

        // Créer la transaction
        if ($this->type == 'depot') {
            $transaction = $compte->transactions()->create([
                'montant' => $this->montant,
                'type' => 'Dépot',
                'description' => 'Dépot d\'argent',
                'compte_type' => $compteType,
                'mode_retrait' => $this->mode_depot,
                'nom_compte' => $this->nom_compte,
                'numero_compte' => $this->numero_compte,
                'compte_id' => $compte_id,
                'numero_transaction' => $this->numero_transaction,
                'solde' => $compte->solde,
            ]);
        } else {
            // Vérification du solde
            if ($this->montant > $compte->solde) {
                $this->reset();
                session()->flash('error', 'Montant insuffisant dans le solde du compte.');
                return;
            }
            $transaction = $compte->transactions()->create([
                'montant' => $this->montant,
                'type' => 'Retrait',
                'description' => 'Retrait d\'argent',
                'compte_type' => $compteType,
                'mode_retrait' => $this->mode_retrait,
                'nom_compte' => $this->nom_compte,
                'numero_compte' => $this->numero_compte,
                'compte_id' => $compte_id,
                'numero_transaction' => $this->numero_transaction,
                'solde' => $compte->solde,
            ]);

            // Débiter le montant du compte
            $compte->solde -= $this->montant;
            $compte->save();

        }

        // Réinitialiser les champs après soumission
        $this->reset();

        session()->flash('success', 'Transaction créée avec succès.');
    }

    public function render()
    {
        return view('livewire.retrait');
    }
}
