<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminThreadsController extends Controller
{
    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $body = request()->body;
        $owner = request()->owner;
        $from = date( request()->created_at_from);
        $to = date( request()->created_at_to);

        $query = $this->createSearchQuery($body, $owner, $from, $to);

        return $query->paginate(10);

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
        $thread->delete();

        return response([], 204);
    }

    /**
     * Create a query according to search inputs
     *
     * @param $body
     * @param $name
     * @param $from
     * @param $to
     * @return Thread|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($body, $owner, $from, $to)
    {
        $query = Thread::with('owner')
            ->where('body', 'LIKE', '%' . $body . '%')
            ->whereHas('owner', function ($q) use($owner) {
                $q->where('name', 'LIKE', '%' . $owner . '%');
            });

        if($from) {
            $query = $query->where('created_at', '>=', $from);
        }

        if ($to) {
            $query = $query->where('created_at', '<=', $to);
        }

        return $query;
    }
}
