<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTranslationsController extends Controller
{
    public function store(Request $request)
    {
        $translation = new Translation($request->all());

        $translation->save();
    }
}
