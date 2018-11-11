<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Thread;
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
        $this->signIn();

        $thread = make('App\Models\Thread');
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
        $this->signIn();

        $thread = create('App\Models\Thread', [
            'title' => 'Foo title',
            'slug' => 'foo-title'
        ]);

        $this->assertEquals($thread->fresh()->slug, 'foo-title');

        $this->post('/threads', $thread->toArray());

        $this->assertTrue(Thread::where('slug', 'foo-title-2')->exists());

        $this->post('/threads', $thread->toArray());

        $this->assertTrue(Thread::where('slug', 'foo-title-3')->exists());
    }

}
