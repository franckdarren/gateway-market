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



        // Récupérer les permissions
        $createOffres = Permission::where('name', 'create offre')->first();
        $editOffres = Permission::where('name', 'edit offre')->first();
        $deleteOffres = Permission::where('name', 'delete offre')->first();
        $viewOffres = Permission::where('name', 'view offre')->first();

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


        // Assigner des permissions aux rôles
        $administrateur->givePermissionTo([
            $createStartup,
            $editStartup,
            $deleteStartup,
            $viewStartup,

            $createOffres,
            $editOffres,
            $deleteOffres,
            $viewOffres,

            $createInvestisseur,
            $editInvestisseur,
            $deleteInvestisseur,
            $viewInvestisseur,

            $createTransaction,
            $editTransaction,
            $deleteTransaction,
            $viewTransaction,
        ]);

        $startup->givePermissionTo([
            $createStartup,
            $editStartup,
            $deleteStartup,
            $viewStartup,

            $createOffres,
            $editOffres,
            $deleteOffres,
            $viewOffres,

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
