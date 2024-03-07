<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Post::factory()->create(
            [
                'user_id'     => fake()->numberBetween(
                    1,
                    10
                ),
                'category_id' => fake()->numberBetween(
                    1,
                    10
                ),
            ]
        );
        //        for ($i = 20; $i > 0; $i--)
        //        {
        //            Post::factory()->create(
        //                [
        //                    'user_id'     => fake()->numberBetween(
        //                        1,
        //                        10
        //                    ),
        //                    'category_id' => fake()->numberBetween(
        //                        1,
        //                        10
        //                    ),
        //                ]
        //            );
        //        }
        //        for ($i = 100; $i > 0; $i--)
        //        {
        //            Comment::factory()->create([
        //                'commentable_type' => 'App\Models\Post',
        //                'commentable_id'   => fake()->numberBetween(
        //                    20,
        //                    40
        //                ),
        //                'user_id'          => fake()->numberBetween(
        //                    1,
        //                    11
        //                ),
        //            ]);
        //
        //        }
    }
}
