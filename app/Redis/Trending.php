<?php

namespace App\Redis;

use Illuminate\Support\Facades\Redis;

class Trending
{
    /**
     * Get the first five most visited threads
     *
     * @return \Illuminate\Support\Collection
     */
    public function get()
    {
        return collect(Redis::zrevrange($this->cacheKey(), 0, 4))
            ->map(function ($thread) {
                return json_decode($thread);
            });
    }

    /**
     * Mark the thread as visited
     *
     * @param $thread
     */
    public function push($thread)
    {
        Redis::zincrby($this->cacheKey(), 1, json_encode([
            'title' => $thread->title,
            'path' => $thread->path(),
        ]));
    }

    /**
     * Get the key for trending threads
     *
     * @return string
     */
    public function cacheKey()
    {
        return app()->environment('testing') ? 'testing_trending_threads' : 'trending_threads';
    }

    public function reset()
    {
        Redis::del($this->cachekey());
    }
}