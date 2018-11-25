<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Redis\Trending;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(Trending $thrending)
    {
        $search = request('q');

        $threads = Thread::search($search)->paginate(25);

        if (request()->expectsJson()) {
            return $threads;
        }

        $trending = $thrending->get();

        return view('threads.index', compact('threads', 'trending'));
    }
}
