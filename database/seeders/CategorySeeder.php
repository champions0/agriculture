<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Աղբահանությու',
            'Առողջապահություն',
            'Առևտուր և սպասարկում',
            'Արտաքին ձևավորում և գովազդ',
            'Բնապահպանություն',
            'Խմելու ջրամատակարարում և կեղտաջրերի հեռացում',
            'Կոմունալ ծառայություններ',
            'Կրթություն',
            'Մշակույթ',
            'Սոցիալական ապահովություն',
            'Տրանսպորտ և ճանապարհներ',
            'Փողոցային լուսավորություն',
            'Փողոցների (բակերի) մաքրում',
            'Քաղաքաշինություն',
            ];

        foreach ($categories as $category) {
            Category::create([
                    'name' => $category,
                ]
            );
        }

    }
}
