<?php

namespace App\Http\Controllers\Admin\Api;

use App\User;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminUsersController extends Controller
{
    use CheckUserRights;

    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $this->authenticate('User',__FUNCTION__, true);

        $name = request()->name;
        $status = isset(request()->status) ? request()->status : 1;
        $email = request()->email;
        $role = request()->role;
        $permission = request()->permission;

        $query = $this->createSearchQuery($name, $status, $email, $role, $permission);

        return $query->paginate(15);
    }

    /**
     * Create a query according to search inputs
     *
     * @param $name
     * @param $status
     * @param $email
     * @param $role
     * @param $permission
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($name, $status, $email, $role, $permission)
    {
        $query = User::where('name', 'LIKE', '%' . $name . '%')
            ->where('email', 'LIKE', '%' . $email . '%')
            ->where('status', $status)
            ->when($role, function ($query1) use($role) {
                $query1->whereHas('roles', function ($query2) use ($role) {
                    $query2->where('title', $role);
                });
            })
            ->when($permission, function ($query3) use($permission) {
                $query3->whereHas('roles', function ($query4) use ($permission) {
                    $query4->whereHas('permissions', function ($query5) use($permission) {
                        $query5->where('title', $permission);
                    });
                });
            });

        return $query;
    }
}
