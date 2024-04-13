<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * ProductFactory Class
 *
 * This factory class generates fake data for the Product model.
 * It extends the Factory class provided by Laravel.
 *
 * @author mahendradwipurwanto@gmail.com
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array The default state of the product model.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function definition(): array
    {
        // Define the default state of the product model
        // The faker library is used to generate fake data for each attribute
        return [
            'id' => $this->faker->uuid, // Generate a fake UUID
            'name' => $this->faker->name, // Generate a fake name
            'description' => $this->faker->text, // Generate a fake text description
            'price' => $this->faker->randomFloat(2, 1, 1000), // Generate a random float between 1 and 1000 with 2 decimal places
        ];
    }
}
