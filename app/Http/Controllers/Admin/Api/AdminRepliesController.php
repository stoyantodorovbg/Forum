<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRepliesController extends Controller
{
    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $body = request()->body;
        $thread = request()->thread;
        $owner = request()->owner;
        $from = date( request()->created_at_from);
        $to = date( request()->created_at_to);

        $query = $this->createSearchQuery($body, $thread, $owner, $from, $to);

        return $query->paginate(10);

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
        $reply->delete();

        return response([], 204);
    }

    /**
     * Redirect to index page after reply saving
     *
     * @return array
     */
    public function redirectIndex ()
    {
        return ['redirect' => '/admin/replies'];
    }

    /**
     * Create a query according to search inputs
     *
     * @param $title
     * @param $name
     * @param $from
     * @param $to
     * @return reply|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($body, $thread, $owner, $from, $to)
    {
        $query = Reply::with('owner')
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
