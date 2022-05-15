<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
        return 'phone';
    }

    /**
     * The user has been authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->end_contract != null && $user->end_contract < Carbon::now()) {
            $u = auth()->user();
            $u->end_contract = null;
            $u->download_left = 0;
            $u->type = 1;
            $u->save();
            auth()->logout();
            return redirect()->route('login')->withInput()->withErrors(['phone' => 'اعتبار حساب کاربری شما به پایان رسیده است. به منظور شارژ حساب دوباره وارد شوید.']);
        } else {
            if ($user->type === 0) {
                //is superAdmin
                return redirect("/");
            } else if ($user->type == 1) {
                return redirect("/admin");
            }
        }
        return false;
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [
            $this->username() => $request->get($this->username()),
            'password' => $request->password,
//            'active' => "1",
        ];
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $guards = array_keys(config('auth.guards'));
        $guardName = "";
        foreach ($guards as $guard) {
            if (auth()->guard($guard)->check())
                $guardName = $guard;
        }
        $url = '/';
        if ($guardName == 'student') {
          //  $url = route('startStudentExamLogin');
            session()->forget('examId');
        }
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect($url);
    }
    public  function  showLoginForm()
    {
        return view("auth/login");
    }
}
