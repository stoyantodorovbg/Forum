<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Models\Thread');
    }

    /** @test */
    public function a_user_can_browse_threads()
    {
        $response = $this->get('/threads')
            ->assertStatus(200);
    }

    /** @test */
    public function displaying_correctly_thread_content()
    {
        $response = $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function displaying_correctly_a_specific_test()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_filter_threads_according_to_the_tags()
    {
        $channel = create('App\Models\Channel');
        $threadInChannel = create('App\Models\Thread',
            ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Models\Thread',
            ['channel_id' => $channel->id - 1]);
        $this->get('/channels/'.$channel->slug)
            ->assertSee($threadInChannel->body)
            ->assertDontSee($threadNotInChannel->body);
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('App\User', ['name' => 'TestName']));

        $threadTestName = create('App\Models\Thread', ['user_id' => auth()->id()]);
        $otherThread = create('App\Models\Thread');

        $this->get('threads?by=TestName')
            ->assertSee($threadTestName->title)
            ->assertDontSee($otherThread->title);
    }
    /** @test */
    public function a_user_can_filter_threads_by_those_that_are_unanswered()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Models\Reply', ['thread_id' => $thread->id]);

        $response = $this->getJson('threads?unanswered=1')->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    public function authorized_users_can_delete_threads()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Models\Reply', ['thread_id' => $thread->id]);

        $response = $thread->delete();
//        $response = $this->json('DELETE', $thread->path());
//
//        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertDatabaseMissing('activities', [
            'subject_id' => $thread->id,
            'subject_type' => get_class($thread),
        ]);
        $this->assertDatabaseMissing('activities', [
            'subject_id' => $reply->id,
            'subject_type' => get_class($reply),
        ]);

    }

    /** @test */
    public function guests_cannot_delete_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = create('App\Models\Thread');

        $response = $this->json('DELETE', $thread->path());
    }

    /** @test */
    public function threads_may_only_be_deleted_by_those_who_have_a_permission()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = create('App\Models\Thread');

        $this->delete($thread->path());
    }

    /** @test */
    public function a_user_can_request_all_replies_for_a_given_thread ()
    {
        $thread = create('App\Models\Thread');

        create('App\Models\Reply', ['thread_id' => $thread->id], 5);

        $response = $this->getJson($thread->path() . '/replies')->json();

        $this->assertCount(3, $response['data']);
    }

    /** @test */
    public function a_thread_can_be_subscribed_to()
    {
        $thread = create('App\Models\Thread');

        $this->signIn();

        $thread->subscribe();

        $this->assertEquals(
                1,
                $thread
                    ->subscriptions
                    ->where('user_id', auth()->id())->count()
        );
    }

    /** @test */
    public function a_thread_can_be_unsubscribed_from()
    {
        $thread = create('App\Models\Thread');

        $this->signIn();

        $thread->subscribe();

        $thread->unsubscribe(auth()->id());

        $this->assertCount(0, $thread->subscriptions);
    }
}
