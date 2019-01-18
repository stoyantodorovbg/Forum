<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\Right;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminRightsController extends Controller
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
        $this->authenticate('Right',__FUNCTION__, true);

        return view('admin.rights.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authenticate('Right','store', true);

        return view('admin.rights.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authenticate('Right',__FUNCTION__, true);

        $right = new Right($request->all());
        $right->save();

        return redirect()->route('admin.rights.edit', ['right' => $right]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Right  $right
     * @return \Illuminate\Http\Response
     */
    public function edit(Right $right)
    {
        $this->authenticate('Right',__FUNCTION__, true);

        return view('admin.rights.edit',
            compact('right')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Right $right
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Right $right)
    {
        $this->authenticate('Right',__FUNCTION__, true);

        $right->update($request->all());

        return redirect()->back();
    }
}
