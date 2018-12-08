<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        setcookie("language",  $request->language_id, time()+36000000);

        return redirect()->back();
    }
}
