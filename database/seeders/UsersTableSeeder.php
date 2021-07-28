<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([

            [
                'name' => "Sam Drick",
                'email' => "samdrick@gmail.com",
                'password' => Hash::make("123456"),
                'isActive' => 0
            ],

            [
                'name' => "Novus Logics",
                'email' => "novuslogic@gmail.com",
                'password' => Hash::make("123456"),
                'isActive' => 0
            ],
            [
                'name' => "Ajay Diwakar",
                'email' => "ajaydiwakar@gmail.com",
                'password' => Hash::make("123456"),
                'isActive' => 0
            ],
            [
                'name' => "Wilson Palkuri",
                'email' => "wilsonpalkuri@gmail.com",
                'password' => Hash::make("123456"),
                'isActive' => 0
            ],
            [
                'name' => "John Abram",
                'email' => "johnabram@gmail.com",
                'password' => Hash::make("123456"),
                'isActive' => 0
            ],
        ]);
    }
}
