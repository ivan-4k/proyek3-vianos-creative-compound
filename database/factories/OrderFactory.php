<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = $this->faker->numberBetween(50000, 500000);
        $total = $subtotal + $this->faker->numberBetween(0, 50000);

        return [
            'id_users' => User::inRandomOrder()->first()?->id_users ?? User::factory(),
            'order_code' => 'ORD-' . date('Ymd') . '-' . $this->faker->unique()->numerify('####'),
            'queue_number' => $this->faker->optional(0.6)->numberBetween(1, 50),
            'subtotal' => $subtotal,
            'total' => $total,
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed', 'refunded']),
            'order_status' => $this->faker->randomElement(['pending_confirmation', 'processing', 'ready_for_pickup', 'completed', 'cancelled']),
            'notes' => $this->faker->optional(0.4)->sentence(),
        ];
    }
}
