<?php

namespace Tests\Feature;

use App\Models\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class SearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_user_can_search_threads()
    {
        config(['scout.driver' => 'algolia']);

        $search = 'foobar';

        create('App\Models\Thread', [], 2);
        create('App\Models\Thread', ['body' => "A thread with the {$search} term."], 2);

        $results = $this->getJson("/threads/search?q={$search}")->json()['data'];

//        do {
//            sleep(.10);
//            $results = $this->getJson("/threads/search?q={$search}")->json()['data'];
//        } while (empty($results));

       // $results = $this->getJson("/threads/search?q={$search}")->json();

        $this->assertCount(2, $results);

        Thread::latest()->take(4)->unsearchable();
    }
}
