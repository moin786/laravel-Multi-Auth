<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{
    protected $guards;


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;
        if ($guards == "customer") {
            $this->guards = 'customer';
            $this->authenticate($request, $this->guards);
            return $next($request);
        }
        
        if ($guards == "admin") {
            $this->guards = 'web';
            $this->authenticate($request, $this->guards);
            return $next($request);
        } 
        
        if ($guards == "manager") {
            $this->guards = 'admin';
            $this->authenticate($request, $this->guards);
            return $next($request);
        }
        $this->authenticate($request, $guards);

        return $next($request);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        $guards = array_get($this->guards, 0);
        switch($guards) {
            case 'customer':
                if (! $request->expectsJson()) {
                    return route('customer.login');
                }
                break;
            case 'admin':
                if (! $request->expectsJson()) {
                    return route('admin.login');
                }
                break;
            case 'manager':
                if (! $request->expectsJson()) {
                    return route('manager.login');
                }
                break;
            case 'web':
                if (! $request->expectsJson()) {
                    return route('login');
                }
                break;
        }
    }
}
