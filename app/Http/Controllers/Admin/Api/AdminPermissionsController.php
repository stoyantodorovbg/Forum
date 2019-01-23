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
        $status = isset(request()->status) ? request()->status : 1;
        $right = request()->right;

        $query = $this->createSearchQuery($title, $status, $right);

        return $query->paginate(15);

    }

    /**
     * Create a query according to search inputs
     *
     * @param $title
     * @param $status
     * @param $right
     * @return Permission|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($title, $status, $right)
    {
        $query = Permission::where('title', 'LIKE', '%' . $title . '%')
            ->where('status', $status)
            ->when($right, function ($query1) use($right) {
                $query1->whereHas('rights', function ($query2) use ($right) {
                    $query2->where('title', $right);
                });
            });

        return $query;
    }
}
