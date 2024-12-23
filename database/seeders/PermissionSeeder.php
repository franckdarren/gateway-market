<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gestion des offres
        Permission::create(['name' => 'create offre']);
        Permission::create(['name' => 'edit offre']);
        Permission::create(['name' => 'delete offre']);
        Permission::create(['name' => 'view offre']);

        // Gestion des comptes startups
        Permission::create(['name' => 'create startup']);
        Permission::create(['name' => 'edit startup']);
        Permission::create(['name' => 'delete startup']);
        Permission::create(['name' => 'view startup']);

        // Gestion des comptes investisseurs
        Permission::create(['name' => 'create investisseur']);
        Permission::create(['name' => 'edit investisseur']);
        Permission::create(['name' => 'delete investisseur']);
        Permission::create(['name' => 'view investisseur']);

        // Gestion des transactions
        Permission::create(['name' => 'create transaction']);
        Permission::create(['name' => 'edit transaction']);
        Permission::create(['name' => 'delete transaction']);
        Permission::create(['name' => 'view transaction']);

        // Gestion des users
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'view user']);
    }
}
