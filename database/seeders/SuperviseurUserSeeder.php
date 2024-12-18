<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperviseurUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer l'utilisateur superviseur
        $superviseur = User::create([
            'name' => 'Superviseur',
            'email' => 'superviseur@superviseur.com',
            'password' => bcrypt('password'), // Changez le mot de passe si nécessaire
            'email_verified_at' => Carbon::now(),
        ]);

        // Récupérer le rôle "Administrateur" depuis la base de données
        $role = Role::where('name', 'Superviseur')->first();

        // Vérifier que le rôle existe avant de l'assigner
        if ($role) {
            $superviseur->assignRole($role);
        } else {
            // Si le rôle n'existe pas, lever une exception ou ajouter un message d'erreur
            $this->command->error('Le rôle Superviseur n\'existe pas dans la base de données.');
        }
    }
}
