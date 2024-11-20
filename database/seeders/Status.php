<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Status extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $array = [
            0 =>  [
                "id" => 1,
                "name" => "Test User",
                "email" => "test@example.com",
                "email_verified_at" => "2024-11-15T13:57:27.000000Z",

            ],
              1 => [
                "id" => 2,
                "name" => "teste",
                "email" => "oi@oi.com",
                "email_verified_at" => null,

              ],
              2 =>  [
                "id" => 3,
                "name" => "teste2",
                "email" => "oi@oi.com2",
                "email_verified_at" => null,
              ],
              3 =>  [
                "id" => 3,
                "name" => "teste3",
                "email" => "oi@oi.com3",
                "email_verified_at" => null,
              ]


        ];

       foreach ($array as $key => $value) {
        User::create([
            'name' => $value['nome'],
            'email' => $value['email'],
            'password' => "123456789"
        ]);
       }
    }
}
