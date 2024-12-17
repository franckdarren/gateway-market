<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\CompteInvestisseur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompteInvestisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer l'utilisateur avec le rôle 'Investisseur'
        $startupInvestisseur = User::role('Investisseur')->first();

        // Vérifier si un utilisateur 'Investisseur' existe
        if ($startupInvestisseur) {
            // Vérifier si cet utilisateur n'a pas déjà un CompteInvestisseur
            if (!$startupInvestisseur->compteStartup) {
                // Créer un seul CompteInvestisseur pour cet utilisateur
                CompteInvestisseur::factory()->create([
                    'user_id' => $startupInvestisseur->id, // Assigner l'ID de l'utilisateur
                ]);
            } else {
                $this->command->info("L'utilisateur avec le rôle 'investisseur' a déjà un compte investisseur.");
            }
        } else {
            $this->command->error("Aucun utilisateur avec le rôle 'investisseur' trouvé.");
        }
    }
}
