<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 5);
        $unitPrice = $this->faker->numberBetween(10000, 100000);
        $subtotal = $quantity * $unitPrice;

        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();

        return [
            'id_pesanan' => Order::inRandomOrder()->first()?->id_pesanan ?? Order::factory(),
            'id_produk' => $product->id_produk,
            'product_name_snapshot' => $product->name,
            'unit_price' => $unitPrice,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'notes' => $this->faker->optional(0.3)->sentence(),
        ];
    }
}
