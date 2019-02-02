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
     * @return array
     */
    public function store(Request $request)
    {
        $this->authenticate('MenuItem',__FUNCTION__, true);

        $menuItem = new MenuItem($request->all());
        $menuItem->save();

        return [
            'menuItems' => MenuItem::where('menu_id', $menuItem->menu_id)
                ->orderBy('position')
                ->get(),
            'menuItem' => $menuItem,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MenuItem $menuItem
     * @return array
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        $this->authenticate('MenuItem',__FUNCTION__, true);

        $menuItem->update($request->all());

        return [
            'menuItems' => MenuItem::where('menu_id', $menuItem->menu_id)
                ->orderBy('position')
                ->get(),
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MenuItem $menuItem
     * @return array
     * @throws \Exception
     */
    public function destroy(MenuItem $menuItem)
    {
        $this->authenticate('MenuItem',__FUNCTION__, true);
        $menuItemId = $menuItem->menu_id;

        $menuItem->delete();

        return [
            'menuItems' => MenuItem::where('menu_id', $menuItemId)
                ->orderBy('position')
                ->get(),
        ];
    }
}
