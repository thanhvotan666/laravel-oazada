<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttribute>
 */
class ProductAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fragile' => $this->faker->boolean,
            'biodegradable' => $this->faker->boolean,
            'frozen' => $this->faker->boolean,
            'max_temp' => (random_int(50, 200) / 10) . "*C",
            'expiry' => $this->faker->boolean,
            'expiry_date' => $this->faker->date('Y-m-d'),
        ];
    }
}
