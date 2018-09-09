<?php

namespace App\Http\Controllers;

use App\Models\Thread;

class ThreadSubscriptionController extends Controller
{
    /**
     * @param Thread $thread
     */
    public function store(Thread $thread)
    {
        $thread->subscribe();
    }

    /**
     * @param Thread $thread
     */
    public function destroy(Thread $thread)
    {
        $thread->unsubscribe();
    }
}
