<?php

namespace App\Http\Middleware;
use Auth;
use Illuminate\Support\Facades\Route;
use Closure;
use Illuminate\Http\Request;

class CheckUser
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
                return redirect('/admin/user-management');
            }else{
                return $next($request);
            }
        }else{
            return redirect('/');
        }
    }
}
