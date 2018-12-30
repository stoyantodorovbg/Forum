<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Request;
use App\Models\ThreadTranslation;
use App\Http\Controllers\Controller;

class AdminThreadTranslationsController extends Controller
{
    /**
     * Store new thread translation
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
     * Update a thread translation
     *
     * @param ThreadTranslation $threadTranslation
     * @return array
     */
    public function update(ThreadTranslation $threadTranslation)
    {
        $threadTranslation->update(request()->all());

        $threadId = $threadTranslation->thread->id;

        return [
            'translations' => ThreadTranslation::where('thread_id', $threadId)
                ->with('language')
                ->get()
        ];
    }

    /**
     * Delete a thread translation
     *
     * @param ThreadTranslation $threadTranslation
     * @return array
     * @throws \Exception
     */
    public function destroy(ThreadTranslation $threadTranslation)
    {
        $threadId = $threadTranslation->thread->id;
        $threadTranslation->delete();

        return [
            'translations' => ThreadTranslation::where('thread_id', $threadId)
                ->with('language')
                ->get()
        ];
    }
}
