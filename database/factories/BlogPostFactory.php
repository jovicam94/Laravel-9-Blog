<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(10),
            'content' => fake()->paragraphs(5, true),
            'created_at' => fake()->dateTimeBetween('-3 months')
        ];
    }

    public function new_title_content_state()
    {
        return $this->state(function () {
            return [
                'title' => 'Title of blog post',
                'content' => 'Content of the blog post....'
            ];
        });
    }
}
