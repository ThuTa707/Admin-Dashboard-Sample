<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BanUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   

        if(Auth::user()->is_banned == 1){

            Auth::logout();
            return redirect()->route('login')->with('alert', ['icon' => 'error', 'title' => 'You account has been restricted!!!', 'text' => 'Please Contact Admin']);
            
        }
        return $next($request);
    }
}
