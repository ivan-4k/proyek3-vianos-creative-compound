<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->count() === 0 || $products->count() === 0) {
            return;
        }

        foreach ($users as $user) {
            $takeCount = rand(1, min(4, $products->count()));
            $randomProducts = $products->random($takeCount)->pluck('id_produk');

            foreach ($randomProducts as $productId) {
                $exists = Cart::where('id_users', $user->id_users)
                    ->where('id_produk', $productId)
                    ->exists();

                if (!$exists) {
                    Cart::create([
                        'id_users' => $user->id_users,
                        'id_produk' => $productId,
                        'quantity' => rand(1, 5),
                        'notes' => fake()->optional()->sentence(),
                    ]);
                }
            }
        }
    }
}
