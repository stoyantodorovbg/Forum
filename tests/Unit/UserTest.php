<?php
/**
 * Created by PhpStorm.
 * User: stoyan
 * Date: 03.11.18
 * Time: 20:42
 */

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_user_can_fetch_their_most_recent_reply()
    {
        $user = create('App\User');

        $reply = create('App\Models\Reply', [
            'user_id' => $user->id,
        ]);

        $this->assertEquals($user->lastReply->id, $reply->id);
    }

    /** @test */
    public function an_user_can_determine_their_avatar_path()
    {
        $user = create('App\User');

        $this->assertEquals($user->avatar(), 'avatars/default.jpeg');

        $user->avatar_path = 'avatars/avatar.jpg';

        $this->assertEquals($user->avatar_path, $user->avatar());
    }
}