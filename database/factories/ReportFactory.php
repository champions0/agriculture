<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => mt_rand(3, 40),
            'title' => $this->faker->text(10),
            'text' => $this->faker->text(255),
//            'description' => $this->faker->text(255),
            'status' => mt_rand(0, 3),
        ];
    }
}
