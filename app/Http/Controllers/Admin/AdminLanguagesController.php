<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Models\LanguageTranslation;
use App\Http\Controllers\Controller;

class AdminLanguagesController extends Controller
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
        $this->authenticate('Language',__FUNCTION__, true);

        return view('admin.languages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authenticate('Language','store', true);

        $languages = Language::all();

        return view('admin.languages.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authenticate('Language',__FUNCTION__, true);

        $language = new Language($request->all());
        $language->save();

        if($request->exit) {
            return redirect()->route('admin.languages');
        }

        return redirect()->route('admin.languages.edit', ['language' => $language]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        $this->authenticate('Language',__FUNCTION__, true);

        $languages = Language::all();
        $translations = LanguageTranslation::where('language_id', $language->id)
            ->with('language')
            ->get();

        return view('admin.languages.edit',
            compact('language', 'languages', 'translations')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Language $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $this->authenticate('Language',__FUNCTION__, true);

        $language->update($request->all());

        if($request->exit) {
            return redirect()->route('admin.languages');
        }

        return redirect()->back();
    }
}
