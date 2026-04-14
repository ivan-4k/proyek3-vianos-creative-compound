<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_users' => User::inRandomOrder()->first()?->id_users ?? User::factory(),
            'id_produk' => Product::inRandomOrder()->first()?->id_produk ?? Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'notes' => $this->faker->optional(0.4)->sentence(),
        ];
    }
}
