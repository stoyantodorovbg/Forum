<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Support\Facades\Gate;

class ReplyController extends Controller
{
    /**
     * ReplyController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * @param $channelId
     * @param Thread $thread
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Thread $thread)
    {
        return $thread->replies()->paginate(3);
    }

    /**
     * //* integer $channel_id
     * @param Thread $thread
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
     */
    public function store(Thread $thread)
    {
        if (Gate::denies('create', new Reply)) {
            return response(
                'Sorry, your could not replies twice per minute',
                422
            );
        }

        try {
            $this->validateReply();

            $reply = $thread->addReply([
                'title' => request('body'),
                'body' => request('body'),
                'user_id' => auth()->id(),
            ]);
        } catch (\Exception $e) {
            return response(
                'Sorry, your reply could not be saved at this time',
                422
            );
        }

        return $reply->load('owner');

//        if (request()->expectsJson()) {
//
//        }
//
//        return back()->with('flash', 'Your reply has been left');
    }

    /**
     * @param Reply $reply
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        return back();
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        try {
            $this->validateReply();

            $reply->update(['body' => request('body')]);
        } catch (\Exception $e) {
            return response(
                'Sorry, your reply could not be saved at this time',
                422
            );
        }

        return back();
    }

    protected function validateReply()
    {
        $this->validate(request(), [
            'body' => 'required|spamfree',
            'channel_id' => 'exists:channels,id'
        ]);
    }
}
