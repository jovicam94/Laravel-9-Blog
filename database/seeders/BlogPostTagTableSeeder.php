<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogPostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag_count = Tag::all()->count();

        if ($tag_count === 0)
        {
            $this->command->info("No tags found, skipping assigning tags to blog posts.");
            return;
        }

        $how_many_min = (int)$this->command->ask('Minimum tags on blog post?', 0);
        $how_many_max = min((int)$this->command->ask('Maximum tags on blog post?', $tag_count), $tag_count);

        BlogPost::all()->each(function (BlogPost $post) use($how_many_min, $how_many_max) {
            $take = random_int($how_many_min, $how_many_max);
            $tags = Tag::inRandomOrder()->take($take)->get()->pluck('id');
            $post->tags()->sync($tags);
        });
    }
}
