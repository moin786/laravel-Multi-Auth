<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Customer;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $guard;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        
        $customer = Customer::where('email', $request->email)->first();
        if (!empty($customer->email)) {
            $this->guard = $customer->guards;
            if ($this->attemptLogin($request)) {
                if ($this->guard == "customer") {
                    return redirect('customer/home');
                } else {
                    return redirect('/home');
                }
            }
            
        }
        
        if (Auth::attempt($credentials)) {
            $this->guard = Auth::user()->guards;
            
            if ($this->attemptLogin($request)) {
                if ($this->guard == "web") {
                    return redirect('/home');
                } else if ($this->guard == "admin") {
                    return redirect('admin/home');
                } else if ($this->guard == "manager") {
                    return redirect('manager/home');
                } else if ($this->guard == "customer") {
                    return redirect('customer/home');
                } else {
                    return redirect('/home');
                }
            }
            
        }
        
        return back();
    }
    
    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }
    
    
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard($this->guard);
    }
}
