<?php

namespace App\Http\Controllers\Admin;

use App\Models\Label;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Models\LabelTranslation;
use App\Http\Controllers\Controller;

class AdminLabelsController extends Controller
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
        $this->authenticate('Label',__FUNCTION__, true);

        return view('admin.labels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authenticate('Label','store', true);

        $languages = Language::all();

        return view('admin.labels.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authenticate('Label',__FUNCTION__, true);

        $label = new Label($request->all());
        $label->save();

        if($request->exit) {
            return redirect()->route('admin.labels');
        }

        return redirect()->route('admin.labels.edit', ['label' => $label]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        $this->authenticate('Label',__FUNCTION__, true);

        $languages = Language::all();
        $translations = LabelTranslation::where('label_id', $label->id)
            ->with('language')
            ->get();

        return view('admin.labels.edit',
            compact('label', 'languages', 'translations')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Label $label
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Label $label)
    {
        $this->authenticate('Label',__FUNCTION__, true);

        $label->update($request->all());

        if($request->exit) {
            return redirect()->route('admin.labels');
        }

        return redirect()->back();
    }
}
