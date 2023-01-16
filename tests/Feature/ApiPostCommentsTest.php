<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiPostCommentsTest extends TestCase
{

    use RefreshDatabase;

    public function test_new_blog_post_does_not_have_comments()
    {
        $this->blog_post();

        $response = $this->json('GET', 'api/v1/posts/1/comments');

        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'links', 'meta'])
            ->assertJsonCount(0, 'data');
    }

    public function test_blog_post_has_5_comments()
    {
        $this->blog_post()->each(function (BlogPost $post) {
           $post->comments()->saveMany(
               Comment::factory()->count(5)->make([
                       'user_id' => $this->user()->id
                   ])
           );
        });

        $response = $this->json('GET', 'api/v1/posts/2/comments');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [
                '*' => [
                    'id',
                    'content',
                    'created_at',
                    'user' => [
                        'id',
                        'name'
                    ]
                ]
            ], 'links', 'meta'])
            ->assertJsonCount(5, 'data');
    }

    public function test_adding_comments_when_not_authenticated()
    {
        $this->blog_post();

        $response = $this->actingAs($this->user(), 'api')->json('POST', 'api/v1/posts/3/comments', []);

        $response->assertStatus(422)
            ->assertJson([
                "message" => "The content field is required.",
                "errors" => [
                    "content" => [
                        "The content field is required."
                    ]
                ]
            ]);
    }
}
