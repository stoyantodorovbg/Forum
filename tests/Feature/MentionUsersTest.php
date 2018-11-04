<?php
/**
 * Created by PhpStorm.
 * User: stoyan
 * Date: 03.11.18
 * Time: 23:14
 */

namespace Tests\Feature;


use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class MentionUsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function mentioned_users_in_a_reply_are_notified()
    {
        $gosho = create('App\User', [
            'name' => 'Gosho',
        ]);

        $this->signIn($gosho);

        $pena = create('App\User', [
            'name' => 'Pena',
        ]);

        $thread = create('App\Models\Thread');

        $reply = make('App\Models\Reply', [
            'body' => '@Pena, look at this.',
        ]);

        $this->json('post', $thread->path() . '/replies', $reply->toArray());

        $this->assertCount(1, $pena->notifications);
    }

    /** @test */
    function it_can_fetch_all_mentioned_users_starting_with_the_given_character()
    {
        create('App\User', [
            'name' => 'Gosho',
        ]);

        create('App\User', [
            'name' => 'Gosho1',
        ]);

        create('App\User', [
            'name' => 'Pesho',
        ]);

        $results = $this->json('GET', '/api/users', ['name' =>'Gosho']);

        $this->assertCount(2, $results->json());
    }
}