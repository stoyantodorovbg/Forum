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

        $query = $this->createSearchQuery($title);

        return $query->paginate(15);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Right $right
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Right $right)
    {
        $this->authenticate('Right',__FUNCTION__, true);

        $right->delete();

        return response([], 204);
    }

    /**
     * Create a query according to search inputs
     *
     * @param $title
     * @return Right|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($title)
    {
        $query = Right::where('title', 'LIKE', '%' . $title . '%');

        return $query;
    }
}
