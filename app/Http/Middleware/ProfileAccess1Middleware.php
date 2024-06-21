<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ProfileAccess1Middleware
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
        $response = $next($request);
        if(auth()->user()->profile == User::PROFILE_PROJECTS || auth()->user()->profile == User::PROFILE_ADMINISTRATOR){
            return $response;
        }else{
            return redirect('/');
        }
    }
}
