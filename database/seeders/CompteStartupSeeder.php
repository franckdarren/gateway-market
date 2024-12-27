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
        // Récupérer tous les utilisateurs avec le rôle 'Startup'
        $startupUsers = User::role('Startup')->get();

        // Vérifier si des utilisateurs avec ce rôle existent
        if ($startupUsers->isNotEmpty()) {
            foreach ($startupUsers as $startupUser) {
                // Vérifier si cet utilisateur n'a pas déjà un CompteStartup
                if (!$startupUser->compteStartup) {
                    // Créer un CompteStartup pour cet utilisateur
                    CompteStartup::factory()->create([
                        'user_id' => $startupUser->id, // Assigner l'ID de l'utilisateur
                    ]);
                    $this->command->info("CompteStartup créé pour l'utilisateur avec l'ID : {$startupUser->id}");
                } else {
                    $this->command->info("L'utilisateur avec l'ID : {$startupUser->id} a déjà un compte startup.");
                }
            }
        } else {
            $this->command->error("Aucun utilisateur avec le rôle 'Startup' trouvé.");
        }
    }
}
