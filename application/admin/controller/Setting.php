<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/18/2017
 * Time: 12:08 AM
 */

namespace app\admin\controller;


use think\Config;

class Setting extends BaseAdminController
{
    function changepassword()
    {
        return $this->fetch("changepassword");
    }

    function savepassword()
    {
        $this->validatePostData([
            "oldPassword" => "require",
            "newPassword" => "require"
        ]);

        if (!$this->user->checkPassword($this->request->post("oldPassword"))) {
            $this->error("原密码错误");
        }

        $this->user->password = sha1(md5(Config::get("salt") . $this->request->post("newPassword")));
        $this->user->save();
        $this->redirect("/admin");
    }
}