<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class Artist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == 'event') {
            return redirect()->route('event');
        }

        if (Auth::user()->role == 'artist') {
            return $next($request);
        }

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin');
        }
    }
}
