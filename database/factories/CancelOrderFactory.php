<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CancelOrder>
 */
class CancelOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $by = ['customer', 'supplier'][random_int(0, 1)];
        $cause = [
            'customer' => [
                'Customer changed their mind.',
                'Incorrect product or size selected by the customer.',
                'Customer could not provide payment.',
            ],
            'supplier' => [
                'The product is out of stock.',
                'Incorrect pricing on the product.',
                'Shop is temporarily closed or unable to fulfill orders.',
            ]
        ];
        return [
            'order_id' => 0,
            'cause' => $this->faker->randomElement($cause[$by]),
            'by' => $by
        ];
    }
}
