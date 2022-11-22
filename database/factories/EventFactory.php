<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(10),
            'subject_id' => mt_rand(1, 11),
            'wallpaper' => 'wallpaper/9/6943585195960.jpg',
            'short_description' => $this->faker->text(100),
            'age' => mt_rand(16, 80),
            'gender' => $this->faker->randomElement(['male', 'female', 'all']),
            'start_date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681)),
            'end_date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681)),
            'address' => $this->faker->address(),
            'additional_info' => $this->faker->text(255),
            'status' => mt_rand(0, 2),
        ];
    }
}
