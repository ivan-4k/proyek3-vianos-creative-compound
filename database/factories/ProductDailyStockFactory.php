<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDailyStock>
 */
class ProductDailyStockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stock = $this->faker->numberBetween(10, 100);
        $remainingStock = $this->faker->numberBetween(0, $stock);

        return [
            'id_produk' => Product::inRandomOrder()->first()?->id_produk ?? Product::factory(),
            'date' => $this->faker->date(),
            'stock' => $stock,
            'remaining_stock' => $remainingStock,
        ];
    }
}
