<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        dd(User::hasRole($role, Auth::id()));
        if (! User::hasRole($role, Auth::id())) {
            return redirect('error/403');
        }

        return $next($request);
    }
}
