<?php

namespace App\Http\Controllers\Api;

use App\Models\Thread;
use App\Models\ThreadTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThreadTranslationsController extends Controller
{
    /**
     * Get translation for certain thread and language
     *
     * @param Request $request
     * @return mixed
     */
    public function getThreadTranslation(Request $request)
    {
        return ThreadTranslation::where('thread_id', $request->thread_id)
            ->where('language_id', $request->language_id)
            ->first();
    }

    /**
     * @param Request $request
     * @param Thread $thread
     */
    public function update(Request $request, ThreadTranslation $threadTranslation)
    {
        $threadTranslation->update($request->all());
    }
}
