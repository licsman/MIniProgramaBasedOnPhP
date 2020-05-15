<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function index()
    {
        return view('welcome');
    }
    public function exit()
    {
        session(['user'=>null]);
        return redirect('admin/login')->with('msg','欢迎再次登陆！');
    }

    public function login()
    {
        $input=Input::all();
        $user = User::first();
        if ($input){
            $code = new \Code;
            $getcode = $code->get();
            //判断验证码是否正确
            if (strtoupper($input['code'])!=$getcode){
                return back()->with('msg','验证码输入有误！');
            }
            //判断用户名密码是否正确
            if (($input['user_name']!=$user->user_name)||($input['user_pass']!=Crypt::decrypt($user->user_pass))){
                return back()->with('msg','用户名或密码输入有误！');
            }
            //如果登陆成功，将用户信息写入到session里面
            session(['user'=>$user]);
            return redirect('admin')->with('userInfo',$user);
        }else{
            return view('admin.login');
        }
    }
    //验证码生成方法
    public function code()
    {
        $code = new \Code;
        $code->make();
    }

}
