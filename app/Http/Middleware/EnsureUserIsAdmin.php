<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->user()->isAdmin) {
            return redirect()->back()->with('admin_error', 'Vous n\'avez pas les privilèges nécessaires pour effectuer cette action.')->with('error', 'Vous n\'avez pas les privilèges nécessaires pour effectuer cette action.');
        }

        return $next($request);
    }
}
