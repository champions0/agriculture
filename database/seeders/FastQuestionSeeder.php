<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FastQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\FastQuestion::factory(40)->create();
    }
}
