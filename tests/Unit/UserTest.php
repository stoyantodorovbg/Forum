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
    public function a_user_can_fetch_their_most_recent_reply()
    {
        $user = create('App\User');

        $reply = create('App\Models\Reply', [
            'user_id' => $user->id,
        ]);

        $this->assertEquals($user->lastReply->id, $reply->id);
    }
}