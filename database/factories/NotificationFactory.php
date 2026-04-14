<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
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
            'title' => $this->faker->sentence(3),
            'message' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['order', 'promo', 'system', 'whatsapp']),
            'data' => [
                'order_id' => $this->faker->optional(0.5)->numberBetween(1, 100),
                'promo_code' => $this->faker->optional(0.5)->word(),
            ],
            'is_read' => $this->faker->boolean(50),
            'read_at' => $this->faker->optional(0.5)->dateTime(),
        ];
    }
}
