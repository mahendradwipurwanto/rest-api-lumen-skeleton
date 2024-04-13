<?php

namespace Database\Seeders;

use App\Models\Stock as StockModel;
use Illuminate\Database\Seeder;

/**
 * StockSeeder Class
 *
 * This seeder class is responsible for seeding the 'stocks' table with fake data.
 * It extends the Seeder class provided by Laravel.
 *
 * @author mahendradwipurwanto@gmail.com
 */
class Stock extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function run(): void
    {
        // Create 10 fake stock entries using the Stock factory
        StockModel::factory(10)->create();
    }
}
