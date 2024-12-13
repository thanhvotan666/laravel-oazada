<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Number;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'avatar' => "storage/image/avatar/avatar.png",
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'role' => $this->faker->randomElement(['customer', 'admin', 'supplier', 'writer']),
            'country_id' => random_int(1, 10), // Thay đổi giá trị này để phù hợp với bảng countries
            'remember_token' => Str::random(10),
        ];
    }
}
