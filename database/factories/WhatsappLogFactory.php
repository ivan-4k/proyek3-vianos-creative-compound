<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WhatsappLog>
 */
class WhatsappLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // system logs can be standalone
            'id_pesanan' => $this->faker->optional(0.3)->randomElement(Order::pluck('id_pesanan')->toArray()),
            'id_users' => $this->faker->optional(0.2)->randomElement(User::pluck('id_users')->toArray()),
            'destination_number' => $this->faker->regexify('08[0-9]{9}'),
            'message' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['sent', 'failed', 'pending']),
            'response' => $this->faker->optional(0.5)->paragraph(),
            'type' => $this->faker->randomElement(['order_confirmation', 'payment_reminder', 'pickup_reminder', 'status_update']),
        ];
    }
}
