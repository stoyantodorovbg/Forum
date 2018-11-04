<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ThreadHasNewReply
{
    use SerializesModels, Dispatchable;

    public $thread;

    public $reply;

    /**
     * ThreadHasNewReply constructor.
     * @param $thread
     * @param $reply
     */
    public function __construct($thread, $reply)
    {
        $this->thread = $thread;
        $this->reply = $reply;
    }
}
