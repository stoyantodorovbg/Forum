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

        $query = $this->createSearchQuery($title, $status);

        return $query->paginate(15);

    }

    /**
     * Create a query according to search inputs
     *
     * @param $title
     * @param $status
     * @return Role|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($title, $status)
    {
        $query = Role::where('title', 'LIKE', '%' . $title . '%')
            ->where('status', $status);

        return $query;
    }
}
