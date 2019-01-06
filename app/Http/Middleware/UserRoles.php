<?php

namespace App\Http\Middleware;

use Closure;

class UserRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if ($user = auth()->user()) {
            foreach($roles as $role) {
                if($user->hasRole($role)) {
                    return $next($request);
                }
            }
        }


        return abort(403, 'You do not have permission to perform this action');
    }
}
