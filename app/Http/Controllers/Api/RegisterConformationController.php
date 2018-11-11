<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterConformationController extends Controller
{
    public function index()
    {
        try {
            $user = User::where('confirmation_token', request('token'))
                ->firstOrFail()
                ->confirm()
                ->first();
        } catch (\Exception $e) {
            return redirect('/threads')
                ->with('flash', 'Unknown token.');
            ;
        }


        return redirect('/threads')
            ->with('flash', "Congritulations, $user->name! Your account is now confirmed and you may post into the forum.");
    }
}
