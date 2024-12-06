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
        $user = User::where('role', 'customer')->inRandomOrder()->first();
        return [
            'user_id' => $user->id,
            'country_id' => $user->country->id,
            'supplier_id' => 0,
            'name' => $this->faker->randomElement([$this->faker->name, $user->name]),
            'email' => $this->faker->randomElement([$this->faker->safeEmail, $user->email]),
            'phone' => $this->faker->randomElement([$this->faker->phoneNumber, $user->phone_number ?? $this->faker->phoneNumber]),
            'address_1' => $this->faker->randomElement([$this->faker->address, $user->address ?? $this->faker->address]),
            'address_2' => $this->faker->randomElement([$this->faker->address, null]),
            'country' => $user->country->name,
            'delivery_method' => 'Cash on delivery',
            'discount_code' => null,
            'discount_type' => null,
            'discount_value' => null,
            'total' => 0,
            'items_subtotal' => 0,
            'shipping_cost' => 0,
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipping', 'shipped', 'canceled']),
        ];
    }
}
