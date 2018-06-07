<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForum extends TestCase
{
    use DatabaseMigrations;

//    /** @test */
//    public function unauthenticated_user_may_not_add_replies()
//    {
//        $this->expectException(\Exception::class);
//
//        $thread = factory('App\Models\Thread')->create();
//
//        $reply = factory('App\Models\Reply')->create();
//        $this->post($thread->path().'/replies', $reply->toArray());
//
//    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->be($user = create('App\User'));

        $thread = create('App\Models\Thread');

        $reply = make('App\Models\Thread');
        $this->post($thread->path().'/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);

    }
}
