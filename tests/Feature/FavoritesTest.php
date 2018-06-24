<?php


namespace Tests\Feature;

use PHPUnit\Runner\Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;



class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_can_not_favorite_anything()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('replies/1/favorites')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_favorites_any_reply()
    {
        $this->signIn();

        $reply = create('App\Models\Reply');

        $this->post('replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_can_favorites_a_reply_only_once()
    {
        $this->signIn();

        $reply = create('App\Models\Reply');

        $this->post('replies/' . $reply->id . '/favorites');
        $this->post('replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }
}