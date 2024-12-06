<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryType>
 */
class CategoryTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'My categories',
                'Home Decor',
                'Industrial',
                'Health & Personal Care',
                'Fashion & Beauty',
                'Sports & Entertainment',
                'Tools & Home Improvement',
                'Raw Materials',
                'Maintenance, Repair & Operations',
            ]),
        ];
    }
}
