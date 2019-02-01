<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminMenuItemsController extends Controller
{
    use CheckUserRights;

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return MenuItem
     */
    public function store(Request $request)
    {
        $this->authenticate('MenuItem',__FUNCTION__, true);

        $menuItem = new MenuItem($request->all());
        $menuItem->save();

        return $menuItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MenuItem $menuItem
     * @return MenuItem
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        $this->authenticate('MenuItem',__FUNCTION__, true);

        $menuItem->update($request->all());

        return $menuItem;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MenuItem $menuItem
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(MenuItem $menuItem)
    {
        $this->authenticate('Menu',__FUNCTION__, true);

        $menuItem->delete();

        return response([], 204);
    }
}
