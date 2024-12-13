<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CompteStartup;
use Illuminate\Database\Seeder;
use App\Models\CompteInvestisseur;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleSeeder::class,

            AdminUserSeeder::class,
            StartupUserSeeder::class,
            InvestisseurUserSeeder::class,

            CompteAdminSeeder::class,

            PermissionSeeder::class,
            RolePermissionSeeder::class,

            CompteStartupSeeder::class,
            CompteInvestisseurSeeder::class,
            OffreSeeder::class,

        ]);
    }
}
