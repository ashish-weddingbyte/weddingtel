<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUser
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
        if ($request->session()->exists('user_type')) {
            $user_type = $request->session()->get('user_type');

            if($user_type == 'vendor'){
                return redirect('/vendor/dashboard');
            }

            if($user_type == 'user'){
                return redirect('/tools/dashboard');
            }
        }
    }
}
