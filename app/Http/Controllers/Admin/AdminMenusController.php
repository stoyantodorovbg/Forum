<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Models\MenuTranslation;
use App\Http\Controllers\Controller;

class AdminMenusController extends Controller
{
    use CheckUserRights;

    /**
     * AdminHomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('user-roles:SuperAdmin,Admin,Moderator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authenticate('Menu',__FUNCTION__, true);

        return view('admin.menus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authenticate('Menu','store', true);

        $languages = Language::all();

        return view('admin.menus.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authenticate('Menu',__FUNCTION__, true);

        $menu = new Menu($request->all());
        $menu->save();

        return redirect()->route('admin.menus.edit', ['menu' => $menu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $this->authenticate('Menu',__FUNCTION__, true);

        $languages = Language::all();
        $translations = MenuTranslation::where('menu_id', $menu->id)
            ->with('language')
            ->get();

        return view('admin.menus.edit',
            compact('menu', 'languages', 'translations')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $this->authenticate('Menu',__FUNCTION__, true);

        $menu->update($request->all());

        return redirect()->back();
    }
}
