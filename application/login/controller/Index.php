<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/15/2017
 * Time: 10:40 PM
 */

namespace app\login\controller;

use app\common\controller\BaseController;
use app\common\model\AuthModel;
use app\common\model\UserModel;
use think\Controller;
use think\Cookie;

class Index extends BaseController
{
    public function index()
    {
        return $this->fetch('index');

    }

    public function auth()
    {
        $this->validatePostData([
            "username" => "require",
            "password" => "require"
        ]);
        $user = UserModel::UserLogin(
            $this->request->post("username"),
            $this->request->post("password")
        );

        if ($user == null) {
            $this->error("用户名或密码错误");
        }

        $key = AuthModel::generateAuth($user->id);
        Cookie::set("token", $key);
        $this->redirect("/");
    }
}