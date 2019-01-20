<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminRepliesController extends Controller
{
    use CheckUserRights;

    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $this->authenticate('Reply',__FUNCTION__, true);


        $body = request()->body;
        $thread = request()->thread;
        $owner = request()->owner;
        $from = date( request()->created_at_from);
        $to = date( request()->created_at_to);
        $status = isset(request()->status) ? request()->status : 1;

        $query = $this->createSearchQuery($body, $thread, $owner, $from, $to, $status);

        return $query->paginate(15);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param reply $reply
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Reply $reply)
    {
        $this->authenticate('Reply',__FUNCTION__, true);

        $reply->delete();

        return response([], 204);
    }

    /**
     * Create a query according to search inputs
     *
     * @param $body
     * @param $thread
     * @param $owner
     * @param $from
     * @param $to
     * @param $status
     * @return Reply|\Illuminate\Database\Eloquent\Builder|mixed
     */
    protected function createSearchQuery($body, $thread, $owner, $from, $to, $status)
    {
        $query = Reply::with('owner')
            ->where('status', $status)
            ->where('body', 'LIKE', '%' . $body . '%')
            ->whereHas('owner', function ($q) use($owner) {
                $q->where('name', 'LIKE', '%' . $owner . '%');
            })
            ->whereHas('thread', function ($q) use($thread) {
                $q->where('title', 'LIKE', '%' . $thread . '%');
            })
            ->when($from, function ($q, $from) {
                return $q->where('created_at', '>=', $from);
            })
            ->when($to, function ($q, $to) {
                return $q->where('created_at', '<=', $to);
            });

        return $query;
    }
}
