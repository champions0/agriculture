<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
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

        foreach ($subjects as $subject) {
            Subject::create([
                    'name' => $subject,
                ]
            );
        }
    }
}
