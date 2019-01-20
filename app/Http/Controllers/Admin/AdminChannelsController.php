<?php

namespace App\Http\Controllers\Admin;

use App\Models\Channel;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Models\ChannelTranslation;
use App\Http\Controllers\Controller;

class AdminChannelsController extends Controller
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
        $this->authenticate('Channel',__FUNCTION__, true);

        return view('admin.channels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authenticate('Channel','store', true);

        $languages = Language::all();

        return view('admin.channels.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authenticate('Channel',__FUNCTION__, true);

        $channel = new Channel($request->all());
        $channel->save();

        return redirect()->route('admin.channels.edit', ['channel' => $channel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        $this->authenticate('Channel',__FUNCTION__, true);

        $languages = Language::all();
        $translations = ChannelTranslation::where('channel_id', $channel->id)
            ->with('language')
            ->get();

        return view('admin.channels.edit',
            compact('channel', 'languages', 'translations')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        $this->authenticate('Channel',__FUNCTION__, true);

        $channel->update($request->all());

        return redirect()->back();
    }
}
