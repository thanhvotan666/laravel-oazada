<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $users = User::where('role', 'supplier')->pluck('id')->toArray();
        return [
            'name' => $this->faker->name,
            'company_name' => $this->faker->company,
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'website' => $this->faker->domainName,
            'tax_code' => '',
            'bank_account_number' => $this->faker->creditCardNumber,
            'bank_name' => 'Vietcomback',
            'contact_person' => $this->faker->name,
            'contact_title' => 'Manager',
            'user_id' => $this->faker->unique()->randomElement($users),
        ];
    }
}
