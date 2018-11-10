<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Redis\Trending;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TrendingTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->trending = new Trending();

        $this->trending->reset();

    }

    /** @test */
    public function it_increments_a_thread_score_each_time_it_is_read()
    {
        $this->assertEmpty( $this->trending->get());

        $thread = create('App\Models\Thread');

        $this->call('GET', $thread->path());

        $trending = $this->trending->get();

        $this->assertCount(1, $trending);

        $this->assertEquals($thread->title, $trending[0]->title);

    }
}