<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 12:57 PM
 */

namespace app\login\controller;


use app\admin\controller\User;
use app\common\model\AuthModel;
use app\common\model\UserModel;
use think\Controller;
use think\Cookie;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch("index");
    }

    public function auth()
    {
        $result = $this->validate($this->request->post(), 'LoginFormValidate');
        if ($result !== true) {
            $this->error($result);
        }
        $username = $this->request->post("username");
        $password = $this->request->post("password");
        $user = UserModel::UserLogin($username, $password);
        if ($user == null) {
            $this->error("用户名不存在或密码错误");
        }
        $tokenKey = AuthModel::generateAuth($user->id);
        Cookie::set('token', $tokenKey);
        $this->redirect("/admin");
    }
}
