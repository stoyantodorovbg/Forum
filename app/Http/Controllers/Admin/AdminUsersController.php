<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Language;
use App\Models\Auth\Role;
use Illuminate\Http\Request;
use App\Models\Auth\Permission;
use App\Traits\CheckUserRights;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AdminUsersController extends Controller
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
        $this->authenticate('User',__FUNCTION__, true);
        $roles = Role::where('status', 1)->get();
        $permissions = Permission::where('status', 1)->get();

        return view('admin.users.index',
            compact('roles', 'permissions')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authenticate('User','store', true);

        $languages = Language::all();

        return view('admin.users.create',
            compact('languages')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authenticate('User',__FUNCTION__, true);

        $user = new User($request->all());
        $user->confirmation_token = str_random(25);
        $user->remember_token = str_limit(md5($request['email'].str_random()), 25, '');
        $user->avatar_path = 'avatars/default.jpg';
        $user->password = Hash::make($request['password']);

        $user->save();

        return redirect()->route('admin.users.edit', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authenticate('User',__FUNCTION__, true);

        $allPermissions = Permission::all();
        $userPermissions = $user->permissions;

        $allRoles = Role::all();
        $userRoles = $user->roles;

        return view('admin.users.edit',
            compact(
                'user',
                'allPermissions',
                'userPermissions',
                'allRoles',
                'userRoles'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authenticate('User',__FUNCTION__, true);

        $user->update($request->all());

        if ($request->roles) {
            $rolesIds = explode(',', $request->roles);
            array_pop($rolesIds);
            $user->roles()->sync($rolesIds);
        }

        if ($request->permissions) {
            $permissionsIds = explode(',', $request->permissions);
            array_pop($permissionsIds);
            $user->permissions()->sync($permissionsIds);
        }

        return redirect()->back();
    }
}
