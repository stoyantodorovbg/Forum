<?php

namespace App\Traits;

use Illuminate\Support\Facades\Redis;

trait RecordVisits
{
    /**
     * Record the number of the thread visits
     *
     * @return $this
     */
    public function recordVisit()
    {
        Redis::incr($this->visitsCacheKey());

        return $this;
    }

    /**
     * Get the number of the thread visits
     *
     * @return mixed
     */
    public function visits()
    {
        return Redis::get($this->visitsCacheKey()) ?? 0;
    }

    /**
     * reset the number of the thread visits
     */
    public function resetVisits()
    {
        Redis::del($this->visitsCacheKey());
    }

    /**
     * Get the key for the number of thread visits
     *
     * @return string
     */
    protected function visitsCacheKey()
    {
        return app()->environment('testing') ? "threads_testing.$this->id.visits" : "threads.$this->id.visits";
    }
}