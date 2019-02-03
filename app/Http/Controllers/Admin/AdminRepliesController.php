<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminRepliesController extends Controller
{
    use CheckUserRights;

    /**
     * AdminHomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('user-roles:SuperAdmin,Admin,Moderator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authenticate('Reply',__FUNCTION__, true);

        return view('admin.replies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authenticate('Reply','store', true);

        $threads = Thread::all();
        $users = User::all();

        return view('admin.replies.create', compact('threads', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authenticate('Reply',__FUNCTION__, true);

        $reply = new Reply($request->all());
        $reply->save();

        if($request->exit) {
            return redirect()->route('admin.replies');
        }

        return redirect()->route('admin.replies.edit', ['reply' => $reply]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        $this->authenticate('Reply',__FUNCTION__, true);

        return view('admin.replies.edit', compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        $this->authenticate('Reply',__FUNCTION__, true);

        $reply->update($request->all());

        if($request->exit) {
            return redirect()->route('admin.replies');
        }

        return redirect()->back();
    }
}
