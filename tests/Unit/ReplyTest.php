<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_has_an_owner()
    {
        $reply = create('App\Models\Reply');

        $this->assertInstanceOf('App\User', $reply->owner);
    }

    /** @test */
    public function it_knows_if_it_just_published()
    {
        $reply = create('App\Models\Reply');

        $this->assertTrue($reply->wasJustPublished());

        $reply->created_at = Carbon::now()->subMonth();

        $this->assertFalse($reply->wasJustPublished());
    }

    /** @test */
    public function it_can_detect_all_mentioned_users_in_the_body()
    {
        $reply = create('App\Models\Reply', [
            'body' => '@Mariika wants to talks to @Ivancho'
        ]);

        $this->assertEquals(['Mariika', 'Ivancho'], $reply->mentionedUsers());
    }

    /** @test */
    public function it_wraps_mentioned_users_in_the_body_within_author_tags()
    {
        $reply = create('App\Models\Reply', [
            'body' => 'Hello @Mariika!'
        ]);

        $this->assertEquals(
            'Hello <a href="/profiles/Mariika">@Mariika</a>!',
            $reply->body);
    }

    /** @test */
    public function it_knows_if_it_is_the_best_reply()
    {
        $reply = create('App\Models\Reply');

        $this->assertFalse($reply->isBest());

        $reply->thread->update(['best_reply_id' => $reply->id]);

        $this->assertTrue($reply->fresh()->isBest());
    }

    /** @test */
    public function a_reply_body_is_sanitized_automatically()
    {
        $reply = make('App\Models\Reply', ['body' => '<script>alert("BED")</script><h3>this is ok</h3>']);

        $this->assertEquals($reply->body, '<h3>this is ok</h3>');
    }
}
