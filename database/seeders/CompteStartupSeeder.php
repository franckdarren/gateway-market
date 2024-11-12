<?php

namespace Database\Seeders;

use App\Models\CompteStartup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompteStartupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompteStartup::factory(5)->create();
    }
}
