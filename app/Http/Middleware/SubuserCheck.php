<?php

namespace App\Http\Middleware;

use Closure;

class SubuserCheck
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('subuser_id')) {
            // user value cannot be found in session
            return redirect('/dashboard')->with('error', 'Brak wybranego podopiecznego!');
        }

        return $next($request);
    }
}
