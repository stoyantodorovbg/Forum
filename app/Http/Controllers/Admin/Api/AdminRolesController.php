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

        $query = $this->createSearchQuery($title);

        return $query->paginate(15);

    }

    /**
     * Create a query according to search inputs
     *
     * @param $title
     * @return Role|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($title)
    {
        $query = Role::where('title', 'LIKE', '%' . $title . '%');

        return $query;
    }
}
