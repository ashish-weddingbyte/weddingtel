<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->exists('user_type')) {
            return redirect('/login');
        }else{
            $user_type = $request->session()->get('user_type');
            if($user_type != 'vendor'){
                return redirect('/login');
            }
        }
        return $next($request);
    }
}
