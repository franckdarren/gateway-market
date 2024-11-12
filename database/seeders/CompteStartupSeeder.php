<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CompteStartup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompteStartupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer l'utilisateur avec le rôle 'startup'
        $startupUser = User::role('Startup')->first();

        // Vérifier si un utilisateur 'startup' existe
        if ($startupUser) {
            // Vérifier si cet utilisateur n'a pas déjà un CompteStartup
            if (!$startupUser->compteStartup) {
                // Créer un seul CompteStartup pour cet utilisateur
                CompteStartup::factory()->create([
                    'user_id' => $startupUser->id, // Assigner l'ID de l'utilisateur
                ]);
            } else {
                $this->command->info("L'utilisateur avec le rôle 'startup' a déjà un compte startup.");
            }
        } else {
            $this->command->error("Aucun utilisateur avec le rôle 'startup' trouvé.");
        }
    }
}
