<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

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

        // Création de l'utilisateur
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'type_abonnement' => $validatedData['type_abonnement'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Assigner le rôle à l'utilisateur
        $user->assignRole($validatedData['role']);

        return $user;
    }
}
