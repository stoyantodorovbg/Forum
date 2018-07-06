<?php


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_has_a_profile()
    {
        $user = create('App\User');
        $username = $user->name;

        $this->get("/profiles/$username")
            ->assertSee($username);
    }

    /** @test */
    public function profiles_display_all_threads_created_by_the_associated_user()
    {
        $user = create('App\User');
        $username = $user->name;

        $thread = create('App\Models\Thread', [
                'user_id' => $user->id
            ]);

        $this->get("/profiles/$username")
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}