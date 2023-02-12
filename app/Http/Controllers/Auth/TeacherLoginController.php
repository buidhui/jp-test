<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;


class TeacherLoginController extends Controller

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



    protected $guard = 'teachers';



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

//        $this->middleware('guest:admin');

//        $this->middleware('guest')->except('logout');



    }



    public function showLoginForm()

    {

        return view('auth.teacherLogin');

    }



    public function login(Request $request)

    {
        if (auth()->guard('teachers')->attempt(['email' => $request->email, 'password' => $request->password])) {
//            dd(auth()->guard('admin')->user());
//            return 11;

            return redirect()->intended(route('teacher-dashboard'));
        }


        return redirect()->back()->withErrors([ 'Tài khoản hoặc mật khẩu không chính xác !']);
    }

    public function logout()
    {
//        teachers
        Auth::guard('teachers')->logout();
        return redirect()->route('teacher.login');
    }

}
