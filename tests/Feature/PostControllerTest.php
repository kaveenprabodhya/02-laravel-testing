<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test database when its empty
     *
     * @return void
     */
    public function test_database_when_its_does_not_have_any_posts()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No posts found.');
    }

    /**
     * retrieve a post
     *
     * @return void
     */
    public function test_create_post_and_retrieve_it()
    {
        $post = new BlogPost();
        $post->title = 'New Title';
        $post->content = 'Content of the blog post';
        $post->save();

        $response = $this->get('/posts');

        $response->assertSeeText('New Title');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New Title',
        ]);
    }

    public function test_blog_post_with_comments()
    {
        $post = $this->getDummyBlogPost();
        Comment::factory()->count(4)->create([
            'blog_post_id' => $post->id
        ]);

        $response = $this->get('/posts');
        $response->assertSeeText('4 comments');
    }

    public function test_store_method()
    {
        $params = [
            'title' => 'Valid title',
            'content' => 'at least 5 characters'
        ];
        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('success');
        $this->assertEquals(session('success'), 'Post was created.');
    }

    public function test_store_method_in_fail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x',
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $errors = session('errors');

        $this->assertEquals($errors->get('title')[0], 'The title must be at least 5 characters.');

        // dd($errors->get('title')[0]);
    }
    public function test_update_method()
    {
        // dd($this->usingInMemoryDatabase());
        // $this->usingInMemoryDatabase()
        //     ? $this->refreshInMemoryDatabase()
        //     : $this->refreshTestDatabase();

        $post = new BlogPost();
        $post->title = 'New Title';
        $post->content = 'Content of the blog post';
        $post->save();

        $this->assertDatabaseHas('blog_posts', [
            'title' => $post->title,
            'content' => $post->content
        ]);

        $params = [
            'title' => 'A new named title',
            'content' => 'Content',
        ];

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('success');

        $this->assertEquals(session('success'), 'Post was updated.');
        $this->assertDatabaseMissing('blog_posts', [
            'title' => $post->title,
            'content' => $post->content
        ]);
    }

    public function test_delete_method()
    {
        $post = $this->getDummyBlogPost();
        $this->assertDatabaseHas('blog_posts', [
            'title' => $post->title,
            'content' => $post->content
        ]);
        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('success');

        $this->assertEquals(session('success'), 'Post was deleted.');

        $this->assertDatabaseMissing('blog_posts', [
            'title' => $post->title,
            'content' => $post->content
        ]);
    }
    private function getDummyBlogPost(): BlogPost
    {
        // $post = new BlogPost();
        // $post->title = 'New Title';
        // $post->content = 'Content of the blog post';
        // $post->save();

        return BlogPost::factory()->newTitlePost()->create();

        // return $post;
    }
}