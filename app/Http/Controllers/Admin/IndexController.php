<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index');
    }

    public function info()
    {
        return view('admin.info');
    }

    public function pass_update()
    {
        if ($input=Input::all()){
            $rules=[
                'password'=>'required|between:6,20|confirmed'
            ];
            $messages=[
                'password.required'=>'新密码不能为空！',
                'password.between'=>'新密码必须设置为6到20位！',
                'password.confirmed'=>'新密码与确认密码不一致！'
            ];
            $valid = Validator::make($input,$rules,$messages);
            if ($valid->fails()){
                return back()->withErrors($valid);
            }
            else{
                $user = User::first();
                $origin_password = Crypt::decrypt($user->user_pass);
                $input_password = $input['password_o'];
                if ($origin_password!=$input_password){
                    return back()->with('errors',array('原密码错误，请稍后重试！'));
                }
                else{
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors',array('密码修改成功！'));
                }
            }
        }
        return view('admin.pass');
    }
}