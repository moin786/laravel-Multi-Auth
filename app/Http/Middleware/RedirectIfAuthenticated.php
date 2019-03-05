<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /*if ($guard == "admin" || $guard == "manager") {
            $this->guards = 'web';
        }*/
        switch($guard) {
            case 'customer':
                if (Auth::guard($guard)->check()) {
                    return redirect('customer/home');
                }
                break;
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect('admin/home');
                }
                break;
            case 'manager':
                if (Auth::guard($guard)->check()) {
                    return redirect('manager/home');
                }
                break;
            case 'web':
                if (Auth::guard($guard)->check()) {
                    return redirect('/home');
                }
                break;
        }
        return $next($request);
    }
}
