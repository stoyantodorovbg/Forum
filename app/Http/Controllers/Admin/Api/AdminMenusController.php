<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminMenusController extends Controller
{
    use CheckUserRights;

    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $this->authenticate('Menu',__FUNCTION__, true);

        $title = request()->title;
        $status = isset(request()->status) ? request()->status : 1;

        $query = $this->createSearchQuery($title, $status);

        return $query->paginate(15);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Menu $menu)
    {
        $this->authenticate('Menu',__FUNCTION__, true);

        $menu->delete();

        return response([], 204);
    }

    /**
     * Create a query according to search inputs
     *
     * @param $menu
     * @param $status
     * @return Menu|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($title, $status)
    {
        $query = Menu::where('title', 'LIKE', '%' . $title . '%')
            ->where('status', $status);

        return $query;
    }
}

