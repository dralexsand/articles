<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $authors = Author::get();

        foreach ($authors as $author) {
            $limit = rand(3, 7);
            $i = 0;
            while ($i < $limit) {
                Post::create([
                    'author_id' => $author->id,
                    'title' => $faker->company(),
                    'description' => $faker->text(100),
                    'content' => $faker->text(1000),
                ]);
                $i++;
            }
        }
    }
}
