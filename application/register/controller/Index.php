<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/15/2017
 * Time: 10:40 PM
 */

namespace app\register\controller;

use app\common\controller\BaseController;
use app\common\model\ProfileModel;
use app\common\model\UserModel;

class Index extends BaseController
{
    public function index()
    {
        return $this->fetch('index');

    }

    public function create()
    {
        $this->validatePostData([
            "username" => "require",
            "password" => "require"
        ]);
        $newUser = new UserModel();
        $newUser::createUser($this->request->post("username"), $this->request->post("password"));
        $newUser = UserModel::get(["username"=>$this->request->post("username")]);
        ProfileModel::create([
            "nickname" => $newUser->username,
            "avatar" => "default.png",
            "user_id" => $newUser->id
        ]);
        $this->redirect("/login");
    }


}