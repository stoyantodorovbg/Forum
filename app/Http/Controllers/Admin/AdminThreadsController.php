<?php

namespace App\Http\Controllers\Admin;


use App\User;
use App\Models\Thread;
use App\Models\Channel;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Models\ThreadTranslation;
use App\Http\Controllers\Controller;

class AdminThreadsController extends Controller
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
        $this->authenticate('Thread','index', true);

        return view('admin.threads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authenticate('Reply','store', true);

        $channels = Channel::all();
        $users = User::all();

        return view('admin.threads.create', compact('channels', 'users'));
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

        $thread = new Thread($request->all());
        $thread->save();

        if($request->exit) {
            return redirect()->route('admin.threads');
        }

        return redirect()->route('admin.threads.edit', ['thread' => $thread]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Thread $thread
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Thread $thread)
    {
        $this->authenticate('Reply',__FUNCTION__, true);

        $languages = Language::all();
        $translations = ThreadTranslation::where('thread_id', $thread->id)
            ->with('language')
            ->get();

        return view('admin.threads.edit', compact('thread', 'languages', 'translations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        $this->authenticate('Reply',__FUNCTION__, true);

        $thread->update($request->all());

        if($request->exit) {
            return redirect()->route('admin.threads');
        }

        return redirect()->back();
    }
}
