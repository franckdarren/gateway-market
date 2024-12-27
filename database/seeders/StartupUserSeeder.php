<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $startup1 = User::create([
            'name' => 'Startup Simple',
            'email' => 'startup@startup.com',
            'password' => bcrypt('password'),
            'type_abonnement' => 'Simple',
            'email_verified_at' => Carbon::now(),
        ]);

        $startup2 = User::create([
            'name' => 'Startup Premium',
            'email' => 'startup2@startup.com',
            'password' => bcrypt('password'),
            'type_abonnement' => 'Premium',
            'email_verified_at' => Carbon::now(),
        ]);

        // Récupérer le rôle "Startup" depuis la base de données
        $role = Role::where('name', 'Startup')->first();

        // Vérifier que le rôle existe avant de l'assigner
        if ($role) {
            $startup1->assignRole($role);
            $startup2->assignRole($role);
        } else {
            // Si le rôle n'existe pas, lever une exception ou ajouter un message d'erreur
            $this->command->error('Le rôle Startup n\'existe pas dans la base de données.');
        }
    }
}
