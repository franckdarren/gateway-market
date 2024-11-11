<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InvestisseurUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer l'utilisateur investisseur
        $administrateur = User::create([
            'name' => 'Investisseur',
            'email' => 'investisseur@investisseur.com',
            'password' => bcrypt('password'), // Changez le mot de passe si nécessaire
        ]);

        // Récupérer le rôle "Investisseur" depuis la base de données
        $role = Role::where('name', 'Investisseur')->first();

        // Vérifier que le rôle existe avant de l'assigner
        if ($role) {
            $administrateur->assignRole($role);
        } else {
            // Si le rôle n'existe pas, lever une exception ou ajouter un message d'erreur
            $this->command->error('Le rôle Investisseur n\'existe pas dans la base de données.');
        }
    }
}
