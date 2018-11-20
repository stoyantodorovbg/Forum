<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LockThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function non_administrators_cannot_lock_threads()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->signIn();

        $thread = create('App\Models\Thread', [
            'user_id' => auth()->id(),
        ]);

        $this->post(route('locked-threads.store', $thread))->assertStatus(403);

        $this->assertFalse(!! $thread->fresh()->locked);
    }

    /** @test */
    public function administrators_can_lock_threads()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $thread = create('App\Models\Thread', [
            'user_id' => auth()->id(),
        ]);

        $this->post(route('locked-threads.store', $thread))->assertStatus(200);

        $this->assertTrue(!! $thread->fresh()->locked);
    }

    /** @test */
    public function the_locked_thread_cannot_receives_replies()
    {
        $this->signIn();

        $thread = create('App\Models\Thread');

        $thread->lock();

        $this->post($thread->path() . '/replies', [
            'body' => 'foobar',
            'user' => auth()->id(),
        ])->assertStatus(422);
    }
}