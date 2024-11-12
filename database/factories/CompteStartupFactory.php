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
        return [
            'nom' => $this->faker->company,
            'date_creation' => $this->faker->date(),
            'activite_principale' => $this->faker->catchPhrase,
            'email' => $this->faker->unique()->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'solde' => $this->faker->numberBetween(100000, 10000000),
            'user_id' => User::role('Startup')->inRandomOrder()->first()->id ?? null,
        ];
    }
}
