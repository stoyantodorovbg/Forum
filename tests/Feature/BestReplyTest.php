<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BestReplyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_thread_creator_may_mark_any_reply_as_best_answer()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);

        $replies = create('App\Models\Reply', ['thread_id' => $thread->id], 2);

        $this->postJson(route('best-replies.store', [$replies[1]->id]));

        $this->assertTrue($replies[1]->fresh()->isBest());
    }

    /** @test */
    public function only_a_thread_creator_may_marks_a_thread_as_the_best()
    {
        $this->expectException('Illuminate\Auth\Access\AuthorizationException');

        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);

        $replies = create('App\Models\Reply', ['thread_id' => $thread->id], 2);

        $this->signIn(create('App\User'));

        $this->postJson(route('best-replies.store', [$replies[1]->id]))->assertStatus(403);

        $this->assertFalse($replies[1]->fresh()->isBest());
    }

    /** @test */
    public function if_a_thread_is_deleted_a_thread_is_properly_updated_about_that()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);

        $reply = create('App\Models\Reply', ['thread_id' => $thread->id, 'user_id' => auth()->id()]);

        $thread->markBestReply($reply);

        $this->deleteJson("replies/$reply->id");

        $this->assertNull($thread->fresh()->best_reply_id);
    }
}