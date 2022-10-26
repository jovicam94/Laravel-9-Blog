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
        // Arrange

        $post = $this->create_dummy_blog_post();
        Comment::factory()->count(4)->create([
           'blog_post_id' => $post->id
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
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was created!');
    }

    public function test_store_fail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();
//        dd($messages->getMessages());

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');


    }

    public function test_update_valid()
    {
        $post = $this->create_dummy_blog_post();

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

        $this->actingAs($this->user())
            ->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was updated!');

        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new named title'
        ]);
    }

    public function test_delete()
    {
        $post = $this->create_dummy_blog_post();
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Title of blog post',
            'content' => 'Content of the blog post....'
        ]);

        $this->actingAs($this->user())
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was deleted!');
//        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertSoftDeleted('blog_posts', [
            'title' => 'Title of blog post',
            'content' => 'Content of the blog post....'
        ]);
    }

    private function create_dummy_blog_post(): BlogPost
    {
//        $post = new BlogPost();
//        $post->title = 'Title of blog post';
//        $post->content = 'Content of the blog post....';
//        $post->save();

        return BlogPost::factory()->new_title_content_state()->create();

//        return $post;

    }
}
