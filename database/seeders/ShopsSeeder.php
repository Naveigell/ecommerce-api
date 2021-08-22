<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShopsSeeder extends Seeder
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
            $company = $faker->company;

            DB::table('shops')->insert([
                "account_id"            => $user->id,
                "name"                  => $company,
                "slug"                  => Str::slug($company.Str::random(3)." ".Str::random(6)),
                "description"           => $faker->realText(100),
                "city"                  => $faker->city,
                "address"               => $faker->address,
                "created_at"            => now(),
                "updated_at"            => now(),
            ]);
        }
    }
}
