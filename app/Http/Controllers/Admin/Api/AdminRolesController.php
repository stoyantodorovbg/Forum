<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Auth\Role;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminRolesController extends Controller
{
    use CheckUserRights;

    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $this->authenticate('Role',__FUNCTION__, true);

        $title = request()->title;
        $status = isset(request()->status) ? request()->status : 1;
        $permission = request()->permission;

        $query = $this->createSearchQuery($title, $status, $permission);

        return $query->paginate(15);

    }

    /**
     * Create a query according to search inputs
     *
     * @param $title
     * @param $status
     * @param $permission
     * @return Role|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($title, $status, $permission)
    {
        $query = Role::where('title', 'LIKE', '%' . $title . '%')
            ->where('status', $status)
            ->when($permission, function ($query1) use($permission) {
                $query1->whereHas('permissions', function ($query2) use ($permission) {
                    $query2->where('title', $permission);
                });
            });

        return $query;
    }
}
