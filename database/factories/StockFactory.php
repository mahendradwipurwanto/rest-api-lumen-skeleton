<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    protected $model = Stock::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'product_id' => Product::inRandomOrder()->first()->id, // Fetch random product's id
            'type' => $this->faker->boolean,
            'stock' => $this->faker->randomNumber(2),
        ];
    }
}
