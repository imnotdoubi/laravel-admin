<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/member';

    public function username()
    {
        return 'name';
    }
    
    protected function guard()
    {
        return \Auth::guard('web');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    //简单登录判断处理，详细过程请自行操作
    public function login()
    {
        $username = request()->input('username');
        $password = request()->input('password');
        if (auth('web')->attempt(['name' => $username, 'password' => $password, 'status_at' => 1])) {
            event(new \App\Events\UserEvent(auth('web')->user()));
            return redirect()->intended($this->redirectTo);
        } else {
            return redirect('/login/')->withErrors('用户名或密码错误');
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
