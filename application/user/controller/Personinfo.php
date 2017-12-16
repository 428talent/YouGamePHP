<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/16/2017
 * Time: 12:33 AM
 */

namespace app\user\controller;


use app\common\controller\BaseController;
use app\common\model\ProfileModel;

class Personinfo extends BaseUserController
{
    function index()
    {
        return $this->fetch("index");
    }

    function save()
    {
        $this->validatePostData([
            "nickname" => "require",
        ]);
        $profile = $this->user->profile;
        $profile->save([
            "nickname" => $this->request->post("nickname"),
            "phone" => $this->request->post("phone"),
            "email" => $this->request->post("email"),
        ]);

        $this->redirect("/user/personinfo");
    }
}