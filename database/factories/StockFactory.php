<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * StockFactory Class
 *
 * This factory class generates fake data for the Stock model.
 * It extends the Factory class provided by Laravel.
 *
 * @author mahendradwipurwanto@gmail.com
 */
class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array The default state of the stock model.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function definition(): array
    {
        // Define the default state of the stock model
        // Fetch a random product's ID to associate with the stock entry
        return [
            'id' => $this->faker->uuid, // Generate a fake UUID
            'product_id' => Product::inRandomOrder()->first()->id, // Fetch a random product's ID
            'type' => $this->faker->boolean, // Generate a random boolean value (true or false)
            'stock' => $this->faker->randomNumber(2), // Generate a random number with 2 digits
        ];
    }
}
