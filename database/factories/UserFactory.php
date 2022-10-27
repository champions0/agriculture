<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'surname' => $this->faker->name(),
            'number' => mt_rand(1000000, 9999999),
            'passport' => Str::random(8),
            'email' => $this->faker->unique()->safeEmail(),
            'country_code' => '+374',
            'phone' => $this->faker->randomElement(['91', '93', '94', '95', '96', '98',]) . mt_rand(100000, 999999),
            'address' => $this->faker->address(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'citizen',
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birth_date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681)),
//            'avatar' => $this->faker->image(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
