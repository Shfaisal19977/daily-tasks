<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::factory(100)->create();

        // Attach random categories to each post (many-to-many relationship)
        $categories = Category::all();
        
        foreach ($posts as $post) {
            // Attach 1-3 random categories to each post
            $randomCategories = $categories->random(rand(1, 3));
            $post->categories()->attach($randomCategories);
        }
    }
}
