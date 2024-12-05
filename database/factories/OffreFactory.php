<?php

namespace Database\Factories;

use App\Models\CompteStartup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offre>
 */
class OffreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Générer les valeurs de montant et taux_interet
        $montant = $this->faker->numberBetween(200, 1000) * 10000;
        $taux_interet = $this->faker->randomElement([3, 6, 9, 12, 15, 18, 21]);

        return [
            'nom_projet' => $this->faker->company,
            'description_projet' => $this->faker->paragraph,
            'montant' => $montant,
            'nbre_mois_remboursement' => $this->faker->numberBetween(4, 10),
            'nbre_mois_grace' => $this->faker->numberBetween(1, 3),
            'taux_interet' => $taux_interet,
            'url_business_plan' => 'pdf/business_plan_1.pdf',  // URL vers le fichier PDF business plan
            'url_etude_risque' => 'pdf/etude_risque_1.pdf',  // URL vers le fichier PDF étude de risque
            'van' => $this->faker->numberBetween(50000, 500000),
            'ir' => $this->faker->randomFloat(2, 25, 100),
            'tri' => $this->faker->randomFloat(2, 25, 100),
            'krl' => $this->faker->randomFloat(2, 0, 1),
            'statut' => 'Disponible',

            // Lier l'offre à un compte startup existant
            'compte_startup_id' => CompteStartup::inRandomOrder()->first()->id,

            // Définir compte_investisseur_id comme null
            'compte_investisseur_id' => null,
        ];
    }
}
