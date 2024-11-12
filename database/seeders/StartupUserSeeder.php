<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StartupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer l'utilisateur startup
        $startup = User::create([
            'name' => 'Startup',
            'email' => 'startup@startup.com',
            'password' => bcrypt('password'), // Changez le mot de passe si nécessaire
        ]);

        // Récupérer le rôle "Startup" depuis la base de données
        $role = Role::where('name', 'Startup')->first();

        // Vérifier que le rôle existe avant de l'assigner
        if ($role) {
            $startup->assignRole($role);
        } else {
            // Si le rôle n'existe pas, lever une exception ou ajouter un message d'erreur
            $this->command->error('Le rôle Startup n\'existe pas dans la base de données.');
        }
    }
}
