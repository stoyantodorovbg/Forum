<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForum extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_user_may_not_add_replies()
    {
        $this->expectException(\Exception::class);

        $thread = create('App\Models\Thread');

        $reply = create('App\Models\Reply');
        $this->post($thread->path().'/replies', $reply->toArray());

    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->signIn(create('App\User'));

        $thread = create('App\Models\Thread');

        $reply = make('App\Models\Thread');
        $this->post($thread->path().'/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);

    }

    /** @test */
    public function anauthenticated_users_cannot_delete_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $reply = create('App\Models\Reply');

        $this->delete("/replies/{$reply->id}");
    }


    /** @test */
    public function unauthorized_users_cannot_delete_replies()
    {
        $this->expectException('Illuminate\Auth\Access\AuthorizationException');

        $reply = create('App\Models\Reply');

        $this->signIn()->delete("/replies/{$reply->id}");
    }

    /** @test */
    public function authorized_users_can_delete_replies()
    {
        $this->signIn();

        $reply = create('App\Models\Reply', ['user_id' => auth()->id()]);

        $this->delete("/replies/{$reply->id}")
            ->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }
}
