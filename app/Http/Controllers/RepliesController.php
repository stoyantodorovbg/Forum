<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use App\Forms\CreatePostForm;
use App\Traits\CheckUserRights;
use Illuminate\Support\Facades\Gate;

class RepliesController extends Controller
{
    use CheckUserRights;

    /**
     * RepliesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * @param Thread $thread
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Thread $thread)
    {
        return $thread->replies()->paginate(3);
    }

    /**
     * integer $channel_id
     * @param Thread $thread
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
     */
    public function store(Thread $thread, CreatePostForm $form)
    {
        $this->authenticate('Reply',__FUNCTION__, false);

        if($thread->locked) {
            return response('This thread is locked', 422);
        }

        if (Gate::denies('create', new Reply)) {
            return response(
                'Sorry, your could not replies twice per minute',
                422
            );
        }

        $this->validateReply();

        return $form->persist($thread);
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

        $this->validateReply();

        $reply->update(['body' => request('body')]);

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
