<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::get();

        foreach ($users as $user) {
            $limit = rand(3, 7);
            $i = 0;
            while ($i < $limit) {
                Author::create([
                    'user_id' => $user->id,
                    'first_name' => $faker->firstName(),
                    'last_name' => $faker->lastName(),
                ]);
                $i++;
            }
        }
    }
}
