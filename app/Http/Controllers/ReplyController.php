<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * ReplyController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     //* integer $channel_id
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( Thread $thread)
    {
        $this->validate(request(), [
            'body' => 'required',
            //'channel_id' => 'required|exists:channels,id'
        ]);
        $thread->addReply([
            'title' => request('body'),
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);
        return back();
    }
}
