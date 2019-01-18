<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\Right;
use Illuminate\Http\Request;
use App\Models\Auth\Permission;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminPermissionsController extends Controller
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
        $this->authenticate('Permission',__FUNCTION__, true);

        return view('admin.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authenticate('Permission','store', true);

        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authenticate('Permission',__FUNCTION__, true);

        $permissionsIds = new Permission($request->all());
        $permissionsIds->save();

        return redirect()->route('admin.permissions.edit', ['$permissionsIds' => $permissionsIds]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $this->authenticate('Permission',__FUNCTION__, true);

        $allRights = Right::all();
        $permissionRights = $permission->rights;

        return view('admin.permissions.edit',
            compact( 'permission','allRights', 'permissionRights')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authenticate('Permission',__FUNCTION__, true);

        $permission->update($request->all());

        if ($request->rights) {
            $rightsIds = explode(',', $request->rights);
            array_pop($rightsIds);
            $permission->rights()->sync($rightsIds);
        }

        return redirect()->back();
    }
}