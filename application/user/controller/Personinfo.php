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
    protected $sideNavIndex = "profile";

    function index()
    {
        return $this->fetch("index");
    }

    function save()
    {
        $this->validatePostData([
            "nickname" => "require",
        ]);
        $file = request()->file('avatar');
        if ($file) {
            $saveFileName = md5($file->getSaveName() . time());
            $info = $file->move(ROOT_PATH . 'public' . DS . 'imgs' . DS . 'user' . DS . 'avatar', $saveFileName);
            if ($info) {
            } else {
                $this->error($file->getError());
            }
            $profile = $this->user->profile;
            $profile->save([
                "nickname" => $this->request->post("nickname"),
                "phone" => $this->request->post("phone"),
                "email" => $this->request->post("email"),
                "avatar" => $info->getSaveName()
            ]);
        } else {
            $profile = $this->user->profile;
            $profile->save([
                "nickname" => $this->request->post("nickname"),
                "phone" => $this->request->post("phone"),
                "email" => $this->request->post("email"),
            ]);
        }

        $this->redirect("/user/personinfo");
    }
}