<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Models\MenuTranslation;
use App\Http\Controllers\Controller;

class AdminMenuTranslationsController extends Controller
{
    use CheckUserRights;

    /**
     * Store new menu translation
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->authenticate('Menu',__FUNCTION__, true);

        $translation = new MenuTranslation($request->all());

        $translation->save();

        return [
            'translations' => MenuTranslation::where('menu_id', $request->menu_id)
                ->with('language')
                ->get()
        ];
    }

    /**
     * Update a menu translation
     *
     * @param MenuTranslation $menuTranslation
     * @return array
     */
    public function update(MenuTranslation $menuTranslation)
    {
        $this->authenticate('Menu',__FUNCTION__, true);

        $menuTranslation->update(request()->all());

        $menuId = $menuTranslation->menu->id;

        return [
            'translations' => MenuTranslation::where('menu_id', $menuId)
                ->with('language')
                ->get()
        ];
    }

    /**
     * Delete a menu translation
     *
     * @param MenuTranslation $menuTranslation
     * @return array
     * @throws \Exception
     */
    public function destroy(MenuTranslation $menuTranslation)
    {
        $this->authenticate('Menu',__FUNCTION__, true);

        $menuId = $menuTranslation->menu->id;
        $menuTranslation->delete();

        return [
            'translations' => MenuTranslation::where('menu_id', $menuId)
                ->with('language')
                ->get()
        ];
    }
}
