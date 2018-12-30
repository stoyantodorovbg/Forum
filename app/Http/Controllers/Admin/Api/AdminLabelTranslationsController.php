<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\LabelTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLabelTranslationsController extends Controller
{
    /**
     * Store new label translation
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $translation = new LabelTranslation($request->all());

        $translation->save();

        return [
            'translations' => LabelTranslation::where('label_id', $request->label_id)
                ->with('language')
                ->get()
        ];
    }

    /**
     * Update a label translation
     *
     * @param LabelTranslation $labelTranslation
     * @return array
     */
    public function update(LabelTranslation $labelTranslation)
    {
        $labelTranslation->update(request()->all());

        $labelId = $labelTranslation->label->id;

        return [
            'translations' => LabelTranslation::where('label_id', $labelId)
                ->with('language')
                ->get()
        ];
    }

    /**
     * Delete a label translation
     *
     * @param LabelTranslation $labelTranslation
     * @return array
     * @throws \Exception
     */
    public function destroy(LabelTranslation $labelTranslation)
    {
        $labelId = $labelTranslation->label->id;
        $labelTranslation->delete();

        return [
            'translations' => LabelTranslation::where('label_id', $labelId)
                ->with('language')
                ->get()
        ];
    }
}
