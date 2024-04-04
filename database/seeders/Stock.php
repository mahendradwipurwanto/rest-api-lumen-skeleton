<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Stock extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 10 stock
        \App\Models\Stock::factory(10)->create();
    }
}
