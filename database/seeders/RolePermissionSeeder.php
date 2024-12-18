<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupéreration des rôles
        $startup = Role::where('name', 'Startup')->first();
        $investisseur = Role::where('name', 'Investisseur')->first();
        $administrateur = Role::where('name', 'Administrateur')->first();
        $superviseur = Role::where('name', 'Superviseur')->first();




        // Récupérer les permissions
        $createOffre = Permission::where('name', 'create offre')->first();
        $editOffre = Permission::where('name', 'edit offre')->first();
        $deleteOffre = Permission::where('name', 'delete offre')->first();
        $viewOffre = Permission::where('name', 'view offre')->first();

        $createStartup = Permission::where('name', 'create startup')->first();
        $editStartup = Permission::where('name', 'edit startup')->first();
        $deleteStartup = Permission::where('name', 'delete startup')->first();
        $viewStartup = Permission::where('name', 'view startup')->first();

        $createInvestisseur = Permission::where('name', 'create investisseur')->first();
        $editInvestisseur = Permission::where('name', 'edit investisseur')->first();
        $deleteInvestisseur = Permission::where('name', 'delete investisseur')->first();
        $viewInvestisseur = Permission::where('name', 'view investisseur')->first();

        $createTransaction = Permission::where('name', 'create transaction')->first();
        $editTransaction = Permission::where('name', 'edit transaction')->first();
        $deleteTransaction = Permission::where('name', 'delete transaction')->first();
        $viewTransaction = Permission::where('name', 'view transaction')->first();

        $createUser = Permission::where('name', 'create user')->first();
        $editUser = Permission::where('name', 'edit user')->first();
        $deleteUser = Permission::where('name', 'delete user')->first();
        $viewUser = Permission::where('name', 'view user')->first();


        // Assigner des permissions aux rôles
        $administrateur->givePermissionTo([

            $createUser,
            $editUser,
            $deleteUser,
            $viewUser,

            $createStartup,
            $editStartup,
            $deleteStartup,
            $viewStartup,

            $createOffre,
            $editOffre,
            $deleteOffre,
            $viewOffre,

            $createInvestisseur,
            $editInvestisseur,
            $deleteInvestisseur,
            $viewInvestisseur,

            $createTransaction,
            $editTransaction,
            $deleteTransaction,
            $viewTransaction,
        ]);

        $superviseur->givePermissionTo([
            $editTransaction,
            $viewTransaction,
        ]);

        $startup->givePermissionTo([
            $createStartup,
            $editStartup,
            $deleteStartup,
            $viewStartup,

            $createOffre,
            $editOffre,
            $deleteOffre,
            $viewOffre,

            $createTransaction,
            $viewTransaction,
            $editTransaction,

        ]);

        $investisseur->givePermissionTo([
            $createInvestisseur,
            $editInvestisseur,
            $deleteInvestisseur,
            $viewInvestisseur,

            $createTransaction,
            $viewTransaction,
            $editTransaction,
        ]);
    }
}
