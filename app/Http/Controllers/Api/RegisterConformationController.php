<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterConformationController extends Controller
{
    public function index()
    {
        $user = User::where('confirmation_token', request('token'))->first();

        if(!$user) {
            return redirect('/threads')
                ->with('flash', 'Unknown token.');
            ;
        }

        $user->confirm();

        return redirect('/threads')
            ->with('flash', "Congritulations, $user->name! Your account is now confirmed and you may post into the forum.");
    }
}
