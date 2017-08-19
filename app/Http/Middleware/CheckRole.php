<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
//        if($request->user() === null)
//        {
//            return redirect('\login');
//        }

        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null; /*jezeli role sa okreslone to pozostaja, a jezeli nie, to zmienna bedzie nullem */

        if($request->user()->hasAnyRole($roles))
        {
            return $next($request);
        }

        return redirect('\login');
    }
}
