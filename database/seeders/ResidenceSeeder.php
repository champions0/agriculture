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
            'Մշակույթ',
            'Բիզնես',
            'Ֆինանսներ',
            'Կրթություն',
            'Սպորտ',
            'Գյուղատնտեսություն',
            'Ուսանողական',
            'Դպրոցական',
            'Մանկապառտեզ',
            'Երիտասարդական',
            'Սոց-հասարակական',
        ];

        foreach ($residences as $residence) {
            Residence::create([
                    'name' => $residence,
                ]
            );
        }
    }
}
