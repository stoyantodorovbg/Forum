<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAvatarController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'avatar_path' => ['required', 'image']
        ]);

        auth()->user()->update([
            'avatar_path' => request()->file('avatar_path')->store('avatars', 'public')
        ]);

        return back();
    }
}
