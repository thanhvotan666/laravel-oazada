<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stock = random_int(0, 100);
        return [
            'product_id' => '',
            'image' => "storage/image/product-variant/" . $this->faker->image(public_path('storage/image/product-variant/')),
            'weight' => random_int(1, 1000) / 1000,
            'price' => random_int(1, 100),
            'stock' => $stock,
            'total_stock' => $stock,
        ];
    }
}
