<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
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
            $takeCount = rand(1, min(5, $products->count()));
            $randomProducts = $products->random($takeCount)->pluck('id_produk');

            foreach ($randomProducts as $productId) {
                $exists = Favorite::where('id_users', $user->id_users)
                    ->where('id_produk', $productId)
                    ->exists();

                if (!$exists) {
                    Favorite::create([
                        'id_users' => $user->id_users,
                        'id_produk' => $productId,
                    ]);
                }
            }
        }
    }
}
