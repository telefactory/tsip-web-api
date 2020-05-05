<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Users\User;

class Role
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
        if(!$request->user() instanceof User || !$request->user()->hasRole($roles)){
            abort(403, 'Insufficient privileges');
        }
        return $next($request);
    }
}
