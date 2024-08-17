<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOrKepalaMadrasahOrGuruWali
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(( auth()->user()->id_role == 1) || ( auth()->user()->id_role == 2) || (auth()->user()->id_role == 3) ) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
