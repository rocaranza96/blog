<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /* The code is checking if the currently authenticated user is an admin. If the user is an
        admin, it allows the request to proceed by calling the `` closure with the ``
        parameter. If the user is not an admin, it redirects the user back to the previous page. */
        if (Auth::user()->is_admin) {
            return $next($request);
        }

        return redirect()->back();
    }
}
