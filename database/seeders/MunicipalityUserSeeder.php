<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class MunicipalityUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'first_name' => 'Municipality firstname',
            'last_name' => 'Municipality lastname',
            'surname' => 'Municipality surname',
            'number' => Crypt::encrypt(mt_rand(100000, 999999)),
            'soc_number' => Crypt::encrypt(mt_rand(1000000, 9999999)),
            'email' => 'municipality@gmail.com',
            'country_code' => '+374',
            'phone' => '99114422',
            'address' => 'Gavar Municipality',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'municipality',
            'birth_date' => date("Y-m-d H:i:s", mt_rand(1262055681,1262055681)),
            'status' => '1',
        ]);

    }
}
