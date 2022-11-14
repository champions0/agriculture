<?php

namespace Database\Seeders;

use App\Models\Residence;
use Illuminate\Database\Seeder;

class ResidenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $residences = [
            'Գավառ',
            'Նորատուս',
            'Սարուխան',
            'Կարմիրգյուղ',
            'Գանձակ',
            'Լանջաղբյուր',
            'Ծովազարդ',
            'Գեղարքունիք',
            'Լճափ',
            'Հայրավանք',
            'Ծաղկաշեն',
            'Բերդկունք',
        ];

        foreach ($residences as $residence) {
            Residence::create([
                    'name' => $residence,
                ]
            );
        }
    }
}
