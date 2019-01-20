<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Models\LanguageTranslation;
use App\Http\Controllers\Controller;

class AdminLanguageTranslationsController extends Controller
{
    use CheckUserRights;

    /**
     * Store new language translation
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->authenticate('Language',__FUNCTION__, true);

        $translation = new LanguageTranslation($request->all());

        $translation->save();

        return [
            'translations' => LanguageTranslation::where('language_id', $request->language_id)
                ->with('language')
                ->get()
        ];
    }

    /**
     * Update a language translation
     *
     * @param LanguageTranslation $languageTranslation
     * @return array
     */
    public function update(LanguageTranslation $languageTranslation)
    {
        $this->authenticate('Language',__FUNCTION__, true);

        $languageTranslation->update(request()->all());

        $languageId = $languageTranslation->language->id;

        return [
            'translations' => LanguageTranslation::where('language_id', $languageId)
                ->with('language')
                ->get()
        ];
    }

    /**
     * Delete a language translation
     *
     * @param LanguageTranslation $languageTranslation
     * @return array
     * @throws \Exception
     */
    public function destroy(LanguageTranslation $languageTranslation)
    {
        $this->authenticate('Language',__FUNCTION__, true);

        $languageId = $languageTranslation->language->id;
        $languageTranslation->delete();

        return [
            'translations' => LanguageTranslation::where('language_id', $languageId)
                ->with('language')
                ->get()
        ];
    }
}
