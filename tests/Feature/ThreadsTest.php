<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Models\Thread');
    }

    /** @test */
    public function a_user_can_browse_threads()
    {
        $this->get('/threads')
            ->assertStatus(200);
    }

    /** @test */
    public function displaying_correctly_thread_content()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function displaying_correctly_a_specific_test()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function authorized_users_can_delete_threads()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Models\Reply', ['thread_id' => $thread->id]);

        $response = $thread->delete();
//        $response = $this->json('DELETE', $thread->path());
//
//        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertDatabaseMissing('activities', [
            'subject_id' => $thread->id,
            'subject_type' => get_class($thread),
        ]);
        $this->assertDatabaseMissing('activities', [
            'subject_id' => $reply->id,
            'subject_type' => get_class($reply),
        ]);

    }

    /** @test */
    public function guests_cannot_delete_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = create('App\Models\Thread');

        $response = $this->json('DELETE', $thread->path());
    }

    /** @test */
    public function threads_may_only_be_deleted_by_those_who_have_a_permission()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = create('App\Models\Thread');

        $this->delete($thread->path());
    }

    /** @test */
    public function a_user_can_request_all_replies_for_a_given_thread ()
    {
        $thread = create('App\Models\Thread');

        create('App\Models\Reply', ['thread_id' => $thread->id], 5);

        $response = $this->getJson($thread->path() . '/replies')->json();

        $this->assertCount(3, $response['data']);
    }

    /** @test */
    public function a_thread_may_be_locked()
    {
        $this->signIn();

        $thread = create('App\Models\Thread');

        $this->assertFalse($thread->locked);

        $thread->lock();

        $this->assertTrue($thread->locked);
    }
}
