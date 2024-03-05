<?php

namespace Database\Seeders;

use App\Entities\Wallets;
use Illuminate\Database\Seeder;

class WalletsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wallets::factory()->count(10)->create();
    }
}
