<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Redis\Trending;

class SearchController extends Controller
{
    public function show(Trending $thrending)
    {
        $search = request('q');

        if (request()->expectsJson()) {
            return Thread::search($search)->paginate(25);
        }

        $trending = $thrending->get();

        return view('threads.search', compact('trending'));
    }
}
