<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        if(isset(Auth::user()->id)){
            if(Auth::user()->role ==1){
                return $next($request);
            }else{
                return redirect('/admin/login');
            }
        }else{
            return redirect('/admin/login');
        }
    }
}
