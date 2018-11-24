<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Channel;
use App\Redis\Trending;
use Illuminate\Http\Request;
use App\Filters\ThreadFilters;
use Illuminate\Support\Facades\Auth;

class ThreadsController extends Controller
{
    /**
     * ThreadsController constructor.
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
    public function index(Channel $channel = null, ThreadFilters $filters, Trending $trending)
    {
        $threads = $this->filterThreads($channel, $filters);

        $trending = $trending->get();

        if(request()->wantsJson()) {
            return $threads;
        }

        return view('threads.index', compact('threads', 'trending'));
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
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|spamfree',
            'body' => 'required|spamfree',
            'channel_id' => 'required|exists:channels,id',
            'image' => 'image',
        ]);

        $threadData = $this->processThreadData($request);

        $thread = Thread::create($threadData);

        if($request->wantsJson()) {
            return response($thread, 201);
        }

        return redirect($thread->path())
            ->with('flash', 'Your thread has been published.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread, Trending $trending)
    {
        // Record when the user has visited this page
        if(auth()->check()) {
            auth()->user()->readThread($thread);
        }

        $thread->visits()->record();

        $trending->push($thread);

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
        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Thread $thread
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $this->validate($request, [
            'title' => 'required|spamfree',
            'body' => 'required|spamfree',
            'channel_id' => 'required|exists:channels,id',
            'image' => 'image',
        ]);

        $threadData = $this->processThreadData($request);

        $thread->update($threadData);

        return view('threads.show', compact('thread'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Channel $channel
     * @param Thread $thread
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
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
            $threads = Thread::where('channel_id', $channel->id)->paginate(12);
        } elseif ($threads = Thread::filter($filters)->paginate(12)) {
        } else {
            // all threads
            $threads = Thread::paginate(12);
        }

        return $threads;
    }

    /**
     * Prepare the data for the thread
     *
     * @param Request $request
     * @return array
     */
    protected function processThreadData(Request $request): array
    {
        $threadData = ['user_id' => Auth::user()->id,
            'title' => $request['title'],
            'body' => $request['body'],
            'channel_id' => $request['channel_id']
        ];

        if (isset($request->image)) {
            $threadData['image'] = request()->file('image')->store('threads', 'public');
        }

        return $threadData;
    }
}
