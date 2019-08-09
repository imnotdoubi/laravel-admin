<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * Show the login page.
     *
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     */
 
    public function getLogin()
    {
        if (!Auth::guard('admin')->guest()) {
            return redirect(config('admin.route.prefix'));
        }

        return view('admin.login');
    }

    /**
     * Handle a login request.
     *
     * @param Request $request
     * 开启验证码时，将下面方法注释去掉 ，同时放开login 页面下的注释
     * @return mixed
     */
   public function postLogin(Request $request)
    {
        $credentials = $request->only(['username', 'password','captcha']);

        $validator = Validator::make($credentials, [
            'username' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        // unset($credentials['captcha']);

        if (Auth::guard('admin')->attempt($credentials)) {
            admin_toastr(trans('admin.login_successful'));

            return redirect()->intended(config('admin.route.prefix'));
        }

        return Redirect::back()->withInput()->withErrors(['username' => $this->getFailedLoginMessage()]);
    }

    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
            ? trans('auth.failed')
            : 'These credentials do not match our records.';
    }

     /**
     * User logout.
     *
     * @return Redirect
     */
    public function getLogout(Request $request)
    {
       Auth::guard('admin')->logout();

        $request->session()->invalidate();

        return redirect(config('admin.route.prefix'));
    }


}
