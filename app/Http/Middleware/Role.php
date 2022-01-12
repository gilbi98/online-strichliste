<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Role
{
    public function handle($request, Closure $next, $roles){

        //enduser = 0, admin = 1, superadmin = 2

        if(Auth::user()->role == 0 && $roles == 'enduser' || Auth::user()->role == 1 && $roles == 'enduser'){
            return $next($request);
        }
        
        if(Auth::user()->role == 1 && $roles == 'admin'){
            return $next($request);
        }

        if(Auth::user()->role == 2 && $roles == 'superadmin'){
            return $next($request);
        }

        else{
            abort(403, "Sie haben nicht die benötigte Berechtigung, um diese Seite zu öffnen");
        }

        
    }
    
}
