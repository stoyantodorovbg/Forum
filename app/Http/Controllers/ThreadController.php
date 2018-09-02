<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Filters\ThreadFilters;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    /**
     * ThreadController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except([
            'index',
            'show'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Channel|null $channel
     * @return \Illuminate\Http\Response
     * @internal param $
     */
    public function index(Channel $channel = null, ThreadFilters $filters)
    {
        $threads = $this->filterThreads($channel, $filters);

        if(request()->wantsJson()) {
            return $threads;
        }

        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $thread = Thread::create([
            'user_id' => Auth::user()->id,
            'title' => $request['title'],
            'body' => $request['body'],
            'channel_id' => $request['channel_id'],
        ]);

        return redirect($thread->path())
            ->with('flash', 'Your thread has been published.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        //$replies = $thread->replies()->paginate(10);

        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        if (request()->wantsJson()) {
            return response([], 204);
        }

        $thread->delete();

        return redirect('/threads');
    }

    /**
     * @param Channel $channel
     * @param ThreadFilters $filters
     * @return \Illuminate\Database\Eloquent\Collection|mixed|static[]
     */
    protected function filterThreads(Channel $channel = null, ThreadFilters $filters)
    {
        if ($channel && $channel->exists()) {
            //filter threads by channel
            $threads = $channel->threads;
        } elseif ($threads = Thread::filter($filters)->get()) {
        } else {
            // all threads
            $threads = Thread::all();
        }

        return $threads;
    }
}
