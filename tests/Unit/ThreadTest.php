<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Models\Thread');
    }

    /** @test */
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    public function a_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->owner);

    }

    /** @test */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'foobar',
            'title' => 'bar',
            'user_id' => 1,
        ]);

        $this->assertCount(1, $this->thread->replies);

    }

    /** @test */
    public function a_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReplies = create('App\Models\Thread');
        create('App\Models\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create('App\Models\Thread');
        create('App\Models\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithNoReplies = $this->thread;

        $response = $this->getJson('threads?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
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

    /** @test */
    public function it_knows_if_the_authenticated_user_is_subscribed()
    {
        $thread = create('App\Models\Thread');

        $this->signIn();

        $this->assertFalse($thread->isSubscribedTo);

        $thread->subscribe();

        $this->assertTrue($thread->isSubscribedTo);

    }
}
