<?php

namespace App\Http\Middleware;

use App\Constants\RoleConstants;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * @param $request
     * @param Closure $next
     * @param ...$roles
     * @return Application|RedirectResponse|Redirector|mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if(!Auth::check()) {
            return redirect('index');
        }

        $user = Auth::user();

        if($user->isAdmin()){
            return $next($request);
        }

        foreach($roles as $role){
            if($user->hasRole($role)){
                return $next($request);
            }
        }

        return redirect()->route('index');
    }
}
