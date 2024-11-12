<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompteInvestisseur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompteInvestisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompteInvestisseur::factory(3)->create();
    }
}
