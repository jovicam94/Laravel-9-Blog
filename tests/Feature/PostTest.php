<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Database\Factories\CommentFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_no_blog_posts_when_nothing_in_database()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No blog posts yet!');
    }

    public function test_see_1_blog_post_when_there_is_1()
    {
        // Arrange
        $post = $this->create_dummy_blog_post();

        // Act

        $response = $this->get('/posts');

        // Assert

        $response->assertSeeText('Title of blog post');

        $response->assertSeeText('No comments yet!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Title of blog post'
        ]);

    }

    public function test_see_1_blog_post_with_comments()
    {
        $user = $this->user();

        // Arrange

        $post = $this->create_dummy_blog_post();
        Comment::factory()->count(4)->create([
            'commentable_id' => $post->id,
            'commentable_type' => BlogPost::class,
            'user_id' => $user->id
        ]);
        $response = $this->get('/posts');

        $response->assertSeeText('4 comments');

    }

    public function test_store_valid()
    {
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302);
    }

    public function test_store_fail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302);



    }

    public function test_update_valid()
    {
        $user = $this->user();
        $post = $this->create_dummy_blog_post($user->id);

//        dd($post->toArray());

//        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Title of blog post',
            'content' => 'Content of the blog post....'
        ]);

        $params = [
            'title' => 'A new named title',
            'content' => 'Content was changed!'
        ];

        $this->actingAs($user)
            ->put("/posts/{$post->id}", $params)
            ->assertStatus(302);

        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new named title'
        ]);
    }

    public function test_delete()
    {
        $user = $this->user();
        $post = $this->create_dummy_blog_post($user->id);
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Title of blog post',
            'content' => 'Content of the blog post....'
        ]);

        $this->actingAs($user)
            ->delete("/posts/{$post->id}")
            ->assertStatus(302);
//        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertSoftDeleted('blog_posts', [
            'title' => 'Title of blog post',
            'content' => 'Content of the blog post....'
        ]);
    }

    private function create_dummy_blog_post($userId = null): BlogPost
    {
//        $post = new BlogPost();
//        $post->title = 'Title of blog post';
//        $post->content = 'Content of the blog post....';
//        $post->save();

        return BlogPost::factory()->new_title_content_state()->create([
            'user_id' => $userId ?? $this->user()->id
        ]);

//        return $post;

    }
}
