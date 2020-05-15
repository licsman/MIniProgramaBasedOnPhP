<?php

namespace App\Http\Controllers\wxapi;

use App\Http\Model\userCode;
use App\Http\Model\userInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class LoginController extends CommonController
{
    protected $appid = "wxf2075255aac51079";
    protected $secret = "7cf257391da450709be89af2bfd99cdc";
    protected $grant_type = "authorization_code";

    public function index()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function wxlogin()
    {
        $input = Input::all();
        dd($input);

        $code = $input['code'];
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$this->appid.'&secret='.$this->secret.'&js_code='.$code.'&grant_type='.$this->grant_type;
        $info = file_get_contents($url);//发送HTTPs请求并获取返回的数据，推荐使用curl
        $json = json_decode($info);//对json数据解码
        $arr = get_object_vars($json);
        $openid = $arr['openid'];
        return $openid;
    }
}
