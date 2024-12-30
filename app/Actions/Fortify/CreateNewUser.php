<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\SubscriptionLog;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Validation des données d'entrée
        $validatedData = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:Startup,Investisseur'],
            'type_abonnement' => ['nullable', 'in:Simple,Premium'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : [],
        ])->validate();

        $isPremium = $validatedData['type_abonnement'] === 'Premium';
        $now = now();

        // Définir les dates liées à l'abonnement
        $trialEndsAt = $isPremium ? $now->addMonths(3) : null;
        $nextChargeAt = $isPremium ? $trialEndsAt->addDay() : null;

        // Création de l'utilisateur
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'type_abonnement' => $validatedData['type_abonnement'],
            'password' => Hash::make($validatedData['password']),

            // Initialisation de l'abonnement
            'is_subscription_active' => $isPremium,
            'subscription_started_at' => $isPremium ? $now : null,
            'trial_ends_at' => $trialEndsAt,
            'subscription_next_charge_at' => $nextChargeAt,
        ]);

        // Assigner le rôle à l'utilisateur
        $user->assignRole($validatedData['role']);

        // Historique
        if ($isPremium) {
            SubscriptionLog::create([
                'user_id' => $user->id,
                'status' => 'activated',
                'changed_at' => $now,
            ]);
        }

        return $user;
    }
}
