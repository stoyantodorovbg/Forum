<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\LabelTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLabelTranslationsController extends Controller
{
    /**
     * Store new translation
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
     * Delete a translation
     *
     * @param LabelTranslation $translation
     * @return array
     * @throws \Exception
     */
    public function destroy(LabelTranslation $translation)
    {
        $labelId = $translation->label->id;
        $translation->delete();

        return [
            'translations' => LabelTranslation::where('label_id', $labelId)
                ->with('language')
                ->get()
        ];
    }
}
