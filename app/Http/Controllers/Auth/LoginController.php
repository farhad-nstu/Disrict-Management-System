<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo(){
        if(auth()->user()->role == "admin"){
            return route('admin.dashboard');
        } elseif(auth()->user()->role == "user") {
            return route('user.dashboard');
        } elseif(auth()->user()->role == "dc") {
            return route('dc.dashboard');
        } elseif(auth()->user()->role == "uno") {
            return route('uno.dashboard');
        } elseif(auth()->user()->role == "mayor") {
            return route('mayor.dashboard');
        } elseif(auth()->user()->role == "chairman") {
            return route('chairman.dashboard');
        } elseif(auth()->user()->role == "pouro_assesor") {
            return route('councilor.dashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
