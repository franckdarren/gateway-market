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
        // Pour chaque compte startup, créer des offres associées
        CompteStartup::all()->each(function ($compteStartup) {
            Offre::factory()->times(20)->create([
                'compte_startup_id' => $compteStartup->id,
            ]);
        });
    }
}
