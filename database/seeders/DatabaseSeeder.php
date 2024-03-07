<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create(
            [
                'name' => 'Abdulaziz Shebani',
                'email' => 'a@a.com',
            ]
        );

        User::factory()->count(10)->create();

        Category::factory(10)->create();

        for ($i = 50; $i > 0; $i--) {
            Post::factory()->create(
                [
                    'user_id' => fake()->numberBetween(1, 11),
                    'category_id' => fake()->numberBetween(1, 10),
                ]
            );
        }
        for ($i = 100; $i > 0; $i--) {
            Comment::factory()->create([
                'commentable_type' => 'App\Models\Post',
                'commentable_id' => fake()->numberBetween(1, 10),
                'user_id' => fake()->numberBetween(1, 11),
            ]);

        }



        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
