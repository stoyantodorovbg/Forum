<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Notifications\ThreadWasUpdated;
use Illuminate\Support\Facades\Notification;
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
    public function a_thread_has_a_path()
    {
        $thread = create('App\Models\Thread');

        $this->assertEquals("/threads/{$thread->slug}", $thread->path());
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
    public function a_thread_notifies_all_subscribers_when_a_reply_is_added()
    {
        Notification::fake();

        $this->signIn();

        $this->thread->subscribe();

        $this->thread->addReply([
            'body' => 'foobar',
            'title' => 'bar',
            'user_id' => 1,
        ]);

        Notification::assertSentTo(auth()->user(), ThreadWasUpdated::class);
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

        $this->assertEquals([3, 2, 0], array_column($response['data'], 'replies_count'));
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

        $this->assertCount(1, $response['data']);
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

    /** @test */
    public function a_thread_can_check_if_the_authenticated_user_has_read_all_replies()
    {
        $this->signIn();

        $thread = create('App\Models\Thread');

        $this->assertTrue($thread->hasUpdatesFor(auth()->user()));

        auth()->user()->readThread($thread);

//        // Simulate that the user visited the thread
//        $key = auth()->user()->visitedThreadCacheKey($thread);
//        cache()->forever($key, Carbon::now());

        $this->assertFalse($thread->hasUpdatesFor(auth()->user()));
    }

    /** @test */
    public function a_thread_records_each_visit()
    {
        $thread = make('App\Models\Thread', ['id' => 1]);

        $thread->visits()->reset();

        $this->assertSame(0, $thread->visits()->count());

        $thread->visits()->record();

        $this->assertEquals(1, $thread->visits()->count());

        $thread->visits()->record();

        $this->assertEquals(2, $thread->visits()->count());
    }

    /** @test */
    public function a_valid_image_must_be_provided()
    {
        $this->signIn();

        $this->expectException('Illuminate\Validation\ValidationException');

        $this->post('/threads', [
            'title' => 'title',
            'body' => 'body',
            'channel_id' => 1,
            'image' => 'not_valid_image'
        ]);
    }
}
