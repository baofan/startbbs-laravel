<?php

namespace App\Http\Controllers\Home;

use App\Http\Logic\UserLogic;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        $data['title'] = '用户';
        $data['new_users'] = (new UserLogic())->getUsers(30, 'new');
        $data['hot_users'] = (new UserLogic())->getUsers(30, 'hot');
        return view('home.user', $data);
    }

    public function login() {

    }

    public function register() {
        if (session('uid')) {
            return redirect('/');
        }
        return view('home.register')->with('title', '注册新用户');
    }

    /**
     * 验证用户注册参数
     */
    public function checkUserInfo() {
        Input::merge(array_map('trim', Input::all()));
        $validator = Validator::make(Input::all(),
            (new RegisterRequest())->rules());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $password = Input::get('password');
            $salt = str_random(6);
            $data = array(
                'nickname' => strip_tags(Input::get('nickname')),
                'password' => password_dohash($password, $salt),
                'salt' => $salt,
                'email' => Input::get('email'),
                'credit' => Config::get('userset.credit_start'),
                'ip' => get_online_ip(),
                'gid' => 3,
                'reg_time' => time(),
                'is_active' => 1
            );
        }
    }


}
