<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        $users = DB::table("users")->get();
        foreach ($users as $user) {
            DB::table('biodatas')->insert([
                "user_id"               => $user->id,
                "gender"                => $faker->randomElement(['Male', 'Female']),
                "phone"                 => $faker->numerify("08##########"),
                "address"               => $faker->address,
                "created_at"            => now(),
                "updated_at"            => now(),
            ]);
        }
    }
}
