<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Closure $next)
    {
        if(session('user_id') != null){
        return $next;
        }
        else{
            return route('loginPage');
        }
    }
}
