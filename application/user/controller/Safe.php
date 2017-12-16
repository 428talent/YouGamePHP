<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/16/2017
 * Time: 12:03 PM
 */

namespace app\user\controller;


use app\common\controller\BaseController;
use think\Config;

class Safe extends BaseUserController
{
    protected $sideNavIndex = "safe";
    public function index()
    {
        return $this->fetch("index");
    }

    public function change()
    {
        $this->validatePostData([
            "uid" => "require",
            "oldPassword" => "require",
            "newPassword" => "require"
        ]);
        if ($this->user->id != $this->request->post("uid")) {
            $this->error("身份验证出错");
        }
        $enOldPassword = sha1(md5(Config::get('salt') . $this->request->post("oldPassword")));
        if ($this->user->password != $enOldPassword) {
            $this->error("原密码错误");
        }
        $enNewPassword = sha1(md5(Config::get('salt') . $this->request->post("newPassword")));

        $this->user->password = $enNewPassword;
        $this->user->save();
        $this->redirect("/user/safe");
    }
}