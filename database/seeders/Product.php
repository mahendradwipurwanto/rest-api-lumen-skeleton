<?php

namespace Database\Seeders;

use App\Models\Product as ProductModel;
use Illuminate\Database\Seeder;

/**
 * ProductSeeder Class
 *
 * This seeder class is responsible for seeding the 'products' table with fake data.
 * It extends the Seeder class provided by Laravel.
 *
 * @author mahendradwipurwanto@gmail.com
 */
class Product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function run(): void
    {
        // Create 10 fake products using the Product factory
        ProductModel::factory(10)->create();
    }
}
