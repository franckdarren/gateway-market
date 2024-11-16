<?php

namespace Database\Seeders;

use App\Models\Offre;
use App\Models\CompteStartup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OffreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pour chaque compte startup, créer deux offres associées
        CompteStartup::all()->each(function ($compteStartup) {
            // Créer deux offres associées
            Offre::factory()->times(50)->create([
                'compte_startup_id' => $compteStartup->id,
            ]);
        });
    }
}
