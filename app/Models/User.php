<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'type_abonnement',

        'trial_ends_at',
        'next_payment_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function compteStartup()
    {
        return $this->hasOne(CompteStartup::class);
    }

    public function compteInvestisseur()
    {
        return $this->hasOne(CompteInvestisseur::class);
    }

    public function compteAdmin()
    {
        return $this->hasOne(CompteAdmin::class);
    }

    // Gestion des abonnements

    /**
     * Met à niveau l'utilisateur vers un abonnement Premium ou Normal.
     */
    public function upgradeSubscription(string $type): void
    {
        DB::transaction(function () use ($type) {
            $now = now();

            // Vérifie si l'utilisateur revient à un type d'abonnement après l'avoir quitté
            if ($this->type_abonnement === $type) {
                throw new \Exception("Vous êtes déjà sur cet abonnement.");
            }

            // Si c'est la première fois et aucune période d'essai n'a été utilisée
            if (!$this->hasHadTrial()) {
                $this->trial_ends_at = $now->addMonths(3);
                $this->next_payment_date = $this->trial_ends_at->addDay();
            } else {
                // Si déjà une période d’essai, facturer immédiatement
                $this->processImmediatePayment($type);
            }

            // Met à jour le type d'abonnement
            $this->type_abonnement = $type;

            // Sauvegarde
            $this->save();
        });
    }

    /**
     * Rétrograde l'utilisateur vers un abonnement Normal.
     */
    public function downgradeToNormal(): void
    {
        $this->upgradeSubscription('Simple');
    }

    /**
     * Rétrograde l'utilisateur vers un abonnement Normal.
     */
    public function upgradeToPremium(): void
    {
        $this->upgradeSubscription('Premium');
    }

    /**
     * Facture l'utilisateur immédiatement pour le type d'abonnement.
     */
    private function processImmediatePayment(string $type): void
    {
        $now = now();

        // Calcul des frais
        $tarif = $this->getSubscriptionTarif($type);

        // Simule le prélèvement (intégrer votre logique de paiement ici)
        $this->paymentAbonnement($tarif);

        // Met à jour la date du prochain paiement
        $this->next_payment_date = $now->addMonth()->startOfDay();

        $this->save();
    }

    /**
     * Simule le prélèvement du montant.
     */
    private function paymentAbonnement(int $amount): void
    {
        // Logique réelle de paiement via une passerelle (Stripe, PayPal, etc.)
        // Exemple : $this->charge($amount);
        $this->compteStartup->solde -= $amount;
    }

    /**
     * Retourne les frais en fonction du type d'abonnement.
     */
    private function getSubscriptionTarif(string $type): int
    {
        $tarif = config('subscription.tarif');
        return $tarif[$type] ?? 0;
    }

    /**
     * Vérifie si l'utilisateur a déjà bénéficié d'une période d'essai.
     */
    public function hasHadTrial(): bool
    {
        return $this->trial_ends_at !== null;
    }

}
