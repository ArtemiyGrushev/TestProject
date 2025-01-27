<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            $order = Order::create([
                'order_number' => 'ORD' . $faker->unique()->numberBetween(1000, 9999),
                'total_price' => $faker->randomFloat(2, 50, 500),
            ]);

            foreach (range(1, 5) as $productIndex) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_name' => $faker->word(),
                    'price' => $faker->randomFloat(2, 10, 100),
                    'quantity' => $faker->numberBetween(1, 3),
                ]);
            }
        }
    }
}
