<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActivityLog>
 */
class ActivityLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_users' => $this->faker->optional(0.2)->randomElement(User::pluck('id_users')->toArray()),
            'action' => $this->faker->randomElement(['create', 'update', 'delete', 'login', 'logout', 'view']),
            'entity' => $this->faker->randomElement(['order', 'product', 'user', 'category', 'setting']),
            'entity_id' => $this->faker->optional(0.7)->numberBetween(1, 100),
            'old_data' => [
                'status' => $this->faker->optional(0.5)->word(),
                'value' => $this->faker->optional(0.5)->sentence(),
            ],
            'new_data' => [
                'status' => $this->faker->optional(0.5)->word(),
                'value' => $this->faker->optional(0.5)->sentence(),
            ],
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
        ];
    }
}
