<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        for ($i = 0; $i < 60; $i++) {
            DB::table('users')->insert([
                "name"              => $faker->name,
                "email"             => $faker->email,
                "password"          => Hash::make(123456),
                "remember_token"    => Str::random(30),
                "created_at"        => now(),
                "updated_at"        => now(),
            ]);
        }
    }
}
