<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $posts = Post::all();
        $tags = Tag::all();

        if ($posts->isEmpty() || $tags->isEmpty()) {
            $this->command->info('No posts or tags found. Make sure you have existing records.');
            return;
        }

        // Attach random tags to each post
        foreach ($posts as $post) {
            $post->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id') // Attach 1-5 random tags per post
            );
        }

        $this->command->info('Post-Tag relationships seeded successfully.');
    }
}
