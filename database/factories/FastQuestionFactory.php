<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

class FastQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => Crypt::encrypt(mt_rand(100000, 999999)),
            'user_id' => mt_rand(2, 42),
            'category_id' => mt_rand(1, 14),
            'address' => $this->faker->address(),
            'description' => $this->faker->text(190),
//            'decline_description' => $this->faker->text(190),
            'status' => mt_rand(0, 1),
            'is_anonymous' => mt_rand(0, 1),
        ];
    }
}
