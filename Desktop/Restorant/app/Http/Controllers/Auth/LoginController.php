<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //  protected $redirectTo;

    public function redirectTo()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return '/admin/home';
            } elseif (auth()->user()->isServer()) {
                return '/server/home';
            } elseif (auth()->user()->isChef()) {
                return '/chef/home';
            }
    }

    return '/'; // Default redirect if user role is not recognized
}

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect('/../login');
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
