<?php

namespace App\Http\Controllers\Admin;

use App\Models\Label;
use App\Models\Language;
use App\Models\LabelTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLabelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.labels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $label = new Label($request->all());
        $label->save();

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
        $label->update($request->all());

        return redirect()->back();
    }
}
