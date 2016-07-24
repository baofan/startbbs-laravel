<?php
/**
 * User: mh
 * Date: 2016/7/18
 * Time: 8:04
 */

namespace App\Http\Logic;


use App\Models\User;

class UserLogic
{
    /**
     * 获取最新用户名字
     * @param $uid
     * @return mixed
     */
    public function getLatestUserName($uid) {
        return User::where('uid', $uid)->pluck('nickname');
    }

    public function getUsers($limit, $ord) {
        if($ord == 'new') {
            $obj = 'uid';
        }
        if($ord == 'hot') {
            $obj = 'lastlogin';
        }
        return User::select(['uid', 'nickname', 'avatar'])
            ->take($limit)
            ->orderBy($obj)
            ->get();
    }

    /**
     * 判断是否登录参数正确
     * @param $email 邮箱
     * @param $password 密码
     * @return bool
     */
    public static function verifyUser($email, $password) {
        $data = User::where('email', $email)->first(['password', 'salt']);
        if($data) {
            $compare = password_dohash($password, $data['salt']);
            return $password == $compare;
        } else {
            return false;
        }
    }


    public static function updateCredit($uid, $credit) {

    }


}