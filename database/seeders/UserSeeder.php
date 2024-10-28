<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Francisco Mora',
            'email' => 'francisco.mora@burben.mx',
            'phone' => '22212324567',
            'rfc' => 'MOFD980123ABC',
            'password' => Hash::make('Admin1234?'),
        ]);

        User::create([
            'name' => 'Andrei Zaragoza',
            'email' => 'andrei.zaragoza@burben.mx',
            'phone' => '0987654321',
            'rfc' => 'MALO990456DEF',
            'password' => Hash::make('Admin1234?'),
        ]);
    }
}
