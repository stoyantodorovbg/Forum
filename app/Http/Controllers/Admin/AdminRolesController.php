<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\Role;
use Illuminate\Http\Request;
use App\Models\Auth\Permission;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminRolesController extends Controller
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
        $this->authenticate('Role',__FUNCTION__, true);
        $permissions = Permission::where('status', 1)->get();

        return view('admin.roles.index',
            compact('permissions')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authenticate('Role','store', true);

        $allPermissions = Permission::all();

        return view('admin.roles.create', compact('allPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authenticate('Role',__FUNCTION__, true);

        $role = new Role($request->all());
        $role->save();

        $permissionsIds = explode(',', $request->permissions);
        array_pop($permissionsIds);
        $role->permissions()->sync($permissionsIds);

        return redirect()->route('admin.roles.edit', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authenticate('Role',__FUNCTION__, true);

        $allPermissions = Permission::all();
        $rolePermissions = $role->permissions;

        return view('admin.roles.edit',
            compact('role', 'allPermissions', 'rolePermissions')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authenticate('Role',__FUNCTION__, true);

        $role->update($request->all());

        if ($request->permissions) {
            $permissionsIds = explode(',', $request->permissions);
            array_pop($permissionsIds);
            $role->permissions()->sync($permissionsIds);
        }

        return redirect()->back();
    }
}
