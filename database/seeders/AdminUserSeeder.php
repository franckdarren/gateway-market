<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer l'utilisateur administrateur
        $administrateur = User::create([
            'name' => 'Administrateur',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'), // Changez le mot de passe si nécessaire
            'email_verified_at' => Carbon::now(),
        ]);

        // Récupérer le rôle "Administrateur" depuis la base de données
        $role = Role::where('name', 'Administrateur')->first();

        // Vérifier que le rôle existe avant de l'assigner
        if ($role) {
            $administrateur->assignRole($role);
        } else {
            // Si le rôle n'existe pas, lever une exception ou ajouter un message d'erreur
            $this->command->error('Le rôle Administrateur n\'existe pas dans la base de données.');
        }
    }
}
