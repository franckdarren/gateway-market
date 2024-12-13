<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\CompteInvestisseur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompteInvestisseur>
 */
class CompteInvestisseurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = CompteInvestisseur::class;
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'pays' => $this->faker->country,
            'etat_province' => $this->faker->state,
            'ville' => $this->faker->city,
            'code_postal' => $this->faker->postcode,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'profession' => $this->faker->jobTitle,
            'solde' => 0,
            'user_id' => User::role('Investisseur')->whereDoesntHave('compteInvestisseur')->inRandomOrder()->first()->id ?? null, // Assurer qu'un investisseur n'a qu'un seul compte
        ];
    }
}
