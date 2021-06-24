<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'email';
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->status == "Active") {
                $request->session()->regenerate();
                $role = Auth::user()->role;
                switch ($role) {
                    case 'Admin':
                        return redirect()->route('admin');
                        break;

                    case 'Staff':
                        return redirect()->route('staff');
                        break;

                    case 'Doctor':
                        return redirect()->route('doctor');
                        break;

                    default:
                        return redirect()->route('login');
                        break;
                }
            } elseif (Auth::user()->status == "Inactive") {
                Session::flash('warning', 'Your account is Inactive');
                Auth::logout();
                return back()->withInput($request->all())->withErrors([
                    'email' => 'Access denied! Your account is Inactive.'
                ]);
            } else {
                Session::flash('warning', 'Your account has been Deleted');
                Auth::logout();
                return back()->withInput($request->all())->withErrors([
                    'email' => 'Access denied! Your account has been Deleted.'
                ]);
            }
        }
        Session::flash('error', 'The provided credentials do not match our records');
        return back()->withInput($request->all())->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }

    public function redirectTo()
    {
        $role = Auth::user()->role;
        switch ($role) {
            case 'Admin':
                return '/admin';
                break;

            case 'Staff':
                return '/staff';
                break;

            case 'Doctor':
                return '/doctor';
                break;
            default:
                return '/login';
                break;
        }
    }
}
