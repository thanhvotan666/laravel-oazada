<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$imagePath = 'storage/image/product/' . fake()->imageUrl('640x480', 'jpg');

        $keywords = ['super', 'premium', 'slim', 'durable', 'fashionable', 'technological'];
        $categories = Category::pluck('id');
        $suppliers = Supplier::pluck('id');
        return [
            'code' => $this->faker->word,
            'name' => $keywords[array_rand($keywords)] . ' ' . $this->faker->words(5, true),
            'description' => $this->faker->paragraph,
            'image' => "storage/image/product/" . $this->faker->image(public_path('storage/image/product/')),
            'is_variant' => $this->faker->boolean,
            'category_id' => $this->faker->randomElement($categories),
            'supplier_id' => $this->faker->randomElement($suppliers),
            'hidden' => false,
        ];
    }
}
