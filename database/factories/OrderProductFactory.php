<?php

namespace Database\Factories;


use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
class OrderProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'product_name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
