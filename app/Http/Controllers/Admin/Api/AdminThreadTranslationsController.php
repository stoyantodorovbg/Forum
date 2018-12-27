<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Request;
use App\Models\ThreadTranslation;
use App\Http\Controllers\Controller;

class AdminThreadTranslationsController extends Controller
{
    /**
     * Store new translation
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $translation = new ThreadTranslation($request->all());

        $translation->save();

        return [
            'translations' => ThreadTranslation::where('thread_id', $request->thread_id)
                ->with('language')
                ->get()
        ];
    }

    /**
     * Delete a translation
     *
     * @param ThreadTranslation $translation
     * @return array
     * @throws \Exception
     */
    public function destroy(ThreadTranslation $translation)
    {
        $threadId = $translation->thread->id;
        $translation->delete();

        return [
            'translations' => ThreadTranslation::where('thread_id', $threadId)
                ->with('language')
                ->get()
        ];
    }
}
