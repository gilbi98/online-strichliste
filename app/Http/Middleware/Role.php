<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Role
{
    public function handle($request, Closure $next, $roles){

        //user = 0, admin = 1, superadmin = 2

        if(Auth::user()->role == 0 && $roles == 'user' || Auth::user()->role == 1 && $roles == 'user'){
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
