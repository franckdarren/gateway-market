<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\CompteStartup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompteStartup>
 */
class CompteStartupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = CompteStartup::class;

    public function definition(): array
    {
        // On s'assure d'avoir un utilisateur avec le rôle 'Startup', sinon on met null
        $userId = User::whereHas('roles', function ($query) {
            $query->where('name', 'Startup');
        })->inRandomOrder()->first()->id ?? null;

        return [
            'nom' => $this->faker->company,
            'date_creation' => $this->faker->date(),
            'activite_principale' => $this->faker->catchPhrase,
            'email' => $this->faker->unique()->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'solde' => 0,
            'user_id' => $userId, // on utilise la variable $userId définie précédemment
        ];
    }
}
