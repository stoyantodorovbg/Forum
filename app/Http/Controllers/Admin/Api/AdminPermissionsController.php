<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Auth\Permission;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminPermissionsController extends Controller
{
    use CheckUserRights;

    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $this->authenticate('Permission',__FUNCTION__, true);

        $title = request()->title;

        $query = $this->createSearchQuery($title);

        return $query->paginate(15);

    }

    /**
     * Create a query according to search inputs
     *
     * @param $title
     * @return Permission|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($title)
    {
        $query = Permission::where('title', 'LIKE', '%' . $title . '%');

        return $query;
    }
}
