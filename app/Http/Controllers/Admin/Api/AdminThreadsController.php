<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Thread;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminThreadsController extends Controller
{
    use CheckUserRights;

    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $this->authenticate('Thread',__FUNCTION__, true);

        $title = request()->title;
        $owner = request()->owner;
        $from = date( request()->created_at_from);
        $to = date( request()->created_at_to);
        $status = isset(request()->status) ? request()->status : 1;

        $query = $this->createSearchQuery($title, $owner, $from, $to, $status);

        return $query->paginate(15);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Thread $thread
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Thread $thread)
    {
        $this->authenticate('Thread',__FUNCTION__, true);

        $thread->delete();

        return response([], 204);
    }

    /**
     * Create a query according to search inputs
     *
     * @param $title
     * @param $owner
     * @param $from
     * @param $to
     * @param $status
     * @return Thread|\Illuminate\Database\Eloquent\Builder|mixed
     */
    protected function createSearchQuery($title, $owner, $from, $to, $status)
    {
        $query = Thread::with('owner')
            ->where('status', $status)
            ->where('title', 'LIKE', '%' . $title . '%')
            ->whereHas('owner', function ($q) use($owner) {
                $q->where('name', 'LIKE', '%' . $owner . '%');
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
