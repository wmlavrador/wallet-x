<?php

namespace Database\Seeders;

use App\Entities\Transactions;
use Illuminate\Database\Seeder;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transactions::factory()->count(10)->create();
    }
}
