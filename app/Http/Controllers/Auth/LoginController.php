<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
//        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if (session('success_title')) {
            toast(session('success_title'), 'success');
        }
        
        if (session('error_title')) {
            toast(session('error_title'), 'error');
        }
        
       return view("auth.login");
    }

    public function login(Request $request)
    {
        if (auth()->guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->route('home_page');

        }
        return redirect()->back()->withErrorTitle(['Tài khoản hoặc mật khẩu không chính xác !'])->with("old_email", $request->email);

    }

    public function logout ()
    {
        Auth::guard('web')->logout();
        return redirect()->route('home_page');
    }
}
