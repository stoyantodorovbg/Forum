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
        $title = request()->title;
        $name = request()->owner;
        $from = date( request()->created_at_from);
        $to = date( request()->created_at_to);

        $query = $this->createSearchQuery($title, $name, $from, $to);

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
     * @param $title
     * @param $name
     * @param $from
     * @param $to
     * @return Thread|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($title, $name, $from, $to)
    {
        $query = Thread::with('owner')
            ->where('title', 'LIKE', '%' . $title . '%')
            ->whereHas('owner', function ($q) use($name) {
                $q->where('name', 'LIKE', '%' . $name . '%');
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
