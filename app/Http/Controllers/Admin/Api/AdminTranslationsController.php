<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTranslationsController extends Controller
{
    /**
     * Store new translation
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $translation = new Translation($request->all());

        $translation->save();

        return [
            'translations' => Translation::where('label_id', $request->label_id)
                ->with('language')
                ->get()
        ];
    }

    /**
     * Delete a translation
     *
     * @param Translation $translation
     * @return array
     * @throws \Exception
     */
    public function destroy(Translation $translation)
    {
        $labelId = $translation->label->id;
        $translation->delete();

        return [
            'translations' => Translation::where('label_id', $labelId)
                ->with('language')
                ->get()
        ];
    }
}
