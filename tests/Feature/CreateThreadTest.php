<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Thread;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = make('App\Models\Thread');

        $this->post('/threads', $thread->toArray());
    }

    /** @test */
    public function guests_may_not_see_the_create_threads_page()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->get('/threads/create');
    }

    /** @test */
    public function new_users_must_confirm_theirs_email_address_before_create_a_thread()
    {
        $user = factory('App\User')->states('unconfirmed')->create();

        $this->signIn($user);

        $thread = make('App\Models\Thread');

        $this->post('/threads', $thread->toArray())
            ->assertRedirect('/threads')
            ->assertSessionHas('flash', 'You must first confirm your email address.');
    }

    /** @test */
    public function an_user_can_create_a_thread()
    {
        Storage::fake('images');

        $this->signIn();

        $thread = make('App\Models\Thread');

        $thread['image'] = UploadedFile::fake()->image('image.jpg');

        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

      /** doesn't work because of enabling exceptions */
    /** @test */
    public function a_request_requires_a_title()
    {
        $this->expectException('Illuminate\Validation\ValidationException');

        $this->signIn();

        $thread = make('App\Models\Thread', ['title' => null]);

        $this->post('/threads', $thread->toArray())
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_an_unuque_slug()
    {
        Storage::fake('images');

        $this->signIn();

        create('App\Models\Thread', [], 2);

        $thread = create('App\Models\Thread', [
            'title' => 'Foo title',
        ]);

        $thread['image'] = UploadedFile::fake()->image('image.jpg');

        $this->assertEquals($thread->fresh()->slug, 'foo-title');

        $thread = $this->postJson('/threads', $thread->toArray())->json();

        $this->assertTrue(Thread::where('slug', 'foo-title-' . $thread['id'])->exists());

        $thread['image'] = UploadedFile::fake()->image('image.jpg');

        $thread = $this->postJson('/threads', $thread)->json();

        $this->assertTrue(Thread::where('slug', 'foo-title-' . $thread['id'])->exists());
    }

    /** @test */
    public function a_thread_with_a_title_that_ends_with_a_number_should_generate_a_proper_slug()
    {
        Storage::fake('images');

        $this->signIn();

        $thread = create('App\Models\Thread', [
            'title' => 'Foo title 24',
        ]);

        $thread['image'] = UploadedFile::fake()->image('image.jpg');

        $this->post('/threads', $thread->toArray());

        $this->assertTrue(Thread::where('slug', 'foo-title-24-2')->exists());

    }
}
