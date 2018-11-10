<?php

namespace App\Redis;

use Illuminate\Support\Facades\Redis;

class Visits
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * reset the number of the thread visits
     */
    public function reset()
    {
        Redis::del($this->cacheKey());

        return $this;
    }

    /**
     * Get the visits count
     *
     * @return int
     */
    public function count()
    {
        return Redis::get($this->cacheKey()) ?? 0;
    }

    public function record()
    {
        Redis::incr($this->cacheKey());

        return $this;
    }

    /**
     * Get the key for the number of thread visits
     *
     * @return string
     */
    protected function cacheKey()
    {
        return app()->environment('testing') ? "threads_testing.$this->model->id.visits" : "threads.$this->model->id.visits";
    }
}