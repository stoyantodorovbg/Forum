<?php


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotificationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_notification_is_prepared_when_the_subscribed_thread_receives_a_notification_from_the_other_user()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);

        $this->post($thread->path() . '/subscriptions');

        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
            'user_id' => create('App\User')->id,
            'title' => 'Some title',
            'body' => 'Some reply is here'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** @test */
    public function a_notification_is_prepared_when_the_subscribed_thread_receives_a_notification_which_is_not_from_the_current_user()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);

        $this->post($thread->path() . '/subscriptions');

        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
            'user_id' => auth()->id(),
            'title' => 'Some title',
            'body' => 'Some reply is here'
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);
    }

    /** @test */
    public function a_user_can_fetch_their_unread_notifications()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);

        $this->post($thread->path() . '/subscriptions');

        $thread->addReply([
            'user_id' => create('App\User')->id,
            'title' => 'Some title',
            'body' => 'Some reply is here'
        ]);

        $response = $this->getJson('/profiles/' . auth()->user()->name . '/notifications/')->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);

        $this->post($thread->path() . '/subscriptions');

        $thread->addReply([
            'user_id' => create('App\User')->id,
            'title' => 'Some title',
            'body' => 'Some reply is here'
        ]);

        $this->assertCount(1 , auth()->user()->unreadNotifications);

        $notificationId = auth()->user()->unreadNotifications->first()->id;

        $this->delete('/profiles/' . auth()->user()->name . '/notifications/' . $notificationId );

        $this->assertCount(0 , auth()->user()->fresh()->unreadNotifications);

    }
}