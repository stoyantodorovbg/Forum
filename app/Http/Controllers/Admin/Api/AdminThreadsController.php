<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminThreadsController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return Thread::paginate(10);
    }
}
