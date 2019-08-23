<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

use Socialite;
use App\Models\User;
use App\Models\Roleuser;
use App\Models\UserPermission;

class SocialController extends Controller
{
    public function githubLogin()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function githubCallback(Request $request)
    {
        $user = Socialite::driver('github')->user();

        //此处省略详细判断逻辑，密码随便写的，到时候你自己设置不一样的
        $account = User::where('oid',$user->id)->first();

        if( !$account )
        {
            $account = User::create([
                'email'     => $user->email,
                'username'  => $user->nickname,
                'name'      => $user->username,
                'oid'       => $user->id,
                'password'  => bcrypt('imnotdoubi'.$user->token),
                'token'     => $user->token,
                'autoflg'   => 1
            ]);

            Roleuser::create([
                'role_id'   => 2,
                'user_id'   => $account->id
            ]);
            UserPermission::create([
                'user_id'       => $account->id,
                'permission_id' => 1
            ]);
        }
        $account->password = "imnotdoubi".$account->token;

        $udata = $account->only(['username', 'password']);

            if (Auth::guard('admin')->attempt($udata)) {
              
                admin_toastr(trans('admin.login_successful'));

                return redirect()->intended(config('admin.route.prefix'));
            }else{
                return view('admin.login');
            }
 
    }
}
