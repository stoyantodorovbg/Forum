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

        $this->assertDatabaseHas('replies', ['body' => $reply->body]);
        $this->assertEquals(1, $thread->fresh()->replies_count);

    }

    /** @test */
    public function unauthenticated_users_cannot_delete_replies()
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
        $this->assertEquals(0, $reply->thread->fresh()->replies_count);

    }

    /** @test */
    public function authorized_users_can_update_threads()
    {
        $this->signIn();

        $reply = create('App\Models\Reply', ['user_id' => auth()->id()]);

        $updatedReply = 'the body has been edited';
        $this->patch("/replies/{$reply->id}", [
            'body' => $updatedReply,
        ]);

        $this->assertDatabaseHas('replies', [
            'id' => $reply->id,
            'body' => $updatedReply,
        ]);
    }

    /** @test */
    public function un_authorized_users_cannot_update_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $reply = create('App\Models\Reply');

        $updatedReply = 'the body has been edited';
        $this->patch("/replies/{$reply->id}", [
            'body' => $updatedReply,
        ]);

        $this->assertDatabaseHas('replies', [
            'id' => $reply->id,
            'body' => $updatedReply,
        ]);
    }

    /** @test */
    public function replies_that_contain_spam_can_not_be_created()
    {
        $this->signIn(create('App\User'));

        $thread = create('App\Models\Thread');

        $reply = make('App\Models\Reply', [
            'body' => 'Yahoo Customer Support',
        ]);

        $this->post($thread->path().'/replies', $reply->toArray())
            ->assertStatus(422);
    }

    /** @test */
    public function a_user_may_replies_maximum_one_per_minute()
    {
        $this->signIn(create('App\User'));

        $thread = create('App\Models\Thread');

        $reply = make('App\Models\Reply', [
            'body' => 'A simple reply.',
        ]);

        $this->post($thread->path().'/replies', $reply->toArray())
            ->assertStatus(201);

        $this->post($thread->path().'/replies', $reply->toArray())
            ->assertStatus(422);
    }
}
