<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Auth\Right;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminRightsController extends Controller
{
    use CheckUserRights;

    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $this->authenticate('Right',__FUNCTION__, true);

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
     * @return Right|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($title, $status)
    {
        $query = Right::where('title', 'LIKE', '%' . $title . '%')
            ->where('status', $status);

        return $query;
    }
}
