<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class UpdateThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function the_owner_of_the_thread_can_update_it()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'channel_id' => 1,
            'title' => 'changed',
            'body' => 'changed'
        ]);

        $thread = $thread->fresh();

        $this->assertEquals('changed', $thread->title);
        $this->assertEquals('changed', $thread->body);
    }

    /** @test */
    public function an_unnouthorized_user_can_not_update_a_thread()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => create('App\User')->id]);

        $this->expectException('Illuminate\Auth\Access\AuthorizationException');

        $this->patch($thread->path(), [
            'channel_id' => 1,
            'title' => 'changed',
            'body' => 'changed'
        ]);
    }

    /** @test */
    public function a_thread_requires_a_title_and_a_body_to_be_updated()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);

        $this->expectException('Illuminate\Validation\ValidationException');

        $this->patch($thread->path());
    }
}
