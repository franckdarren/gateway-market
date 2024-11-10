<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CompteAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompteAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Trouver l'utilisateur admin, vous pouvez ajuster cette logique en fonction de votre base de données
        $adminUser = User::where('email', 'admin@admin.com')->first();

        // Si l'utilisateur admin existe, on crée un compte_admin associé
        if ($adminUser) {
            CompteAdmin::create([
                'solde' => 0,  // Solde initial (ajustez selon votre besoin)
                'user_id' => $adminUser->id,  // Associe le compte admin à l'utilisateur
            ]);
        } else {
            // Si l'utilisateur admin n'existe pas, vous pouvez en créer un pour test (si nécessaire)
            $adminUser = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),  // Remplacez par un mot de passe approprié
            ]);

            // Créer le compte admin pour cet utilisateur
            CompteAdmin::create([
                'solde' => 0,  // Solde initial (ajustez selon votre besoin)
                'user_id' => $adminUser->id,  // Associe le compte admin à l'utilisateur
            ]);
        }

        // Message pour indiquer que le seeder a bien fonctionné
        $this->command->info('Compte admin créé avec succès.');
    }
}
