<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminThreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $title = request()->title;
        $name = request()->owner;

        return Thread::with('owner')
            ->where('title', 'LIKE', '%' . $title . '%')
            ->whereHas('owner', function ($q) use($name) {
                $q->where('name', 'LIKE', '%' . $name . '%');
            })
            ->paginate(10);
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
}
