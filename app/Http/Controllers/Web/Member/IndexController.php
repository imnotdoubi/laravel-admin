<?php

namespace App\Http\Controllers\Web\Member;

use Illuminate\Http\Request;
use App\Models\Web\UserLog;

class IndexController extends Controller
{
    public function index()
    {
       
        $data['user'] = auth('web')->user();
        $data['log']  = UserLog::where('user_id', $data['user']->id)->orderBy('created_at', 'desc')->take(2)->get();
        return view('web.member.vip_index', $data);
    }

    public function edit()
    {
        $data['data']   = auth('web')->user();
        $data['status'] = ""; 
        return view('web.member.userinfo', $data);
    }

    public function userupdate()
    {
        $data = auth('web')->user();
        $data->username = request()->get('username');
        $data->tel = request()->get('tel');
        $data->qq = request()->get('qq');
        $data->email = request()->get('email');
        $data->address = request()->get('address');
        // $data->pic = request()->get('pic');
        try {
            \DB::transaction(function () use ($data) {
                $data->save();
                $data['status'] = "更新成功";
            });
        } catch (\Exception $exception) {
            $this->error_log($exception);
            request()->flash();
            $data['status'] = "更新失败"; 
        }
        
        $data['data'] = $data ;
        return view('web.member.userinfo', $data);
        
    }

    public function password()
    {
        $data['data']   = auth('web')->user();
        $data['status'] = ""; 
        return view('web.member.password', $data);
    }

    public function passwords()
    {

        $data = auth('web')->user();
        $data->password = \Hash::make(request()->get('password'));
        if ($data->save()) {
             $data['status'] = "更新成功";
        }else
            $data['status'] = "更新失败"; 
        $data['data'] = $data ;
        return view('web.member.password', $data);
    }


   
    public function search()
    {
        $data['kw'] = request()->get('kw');
        return view('search', $data);
    }

}
