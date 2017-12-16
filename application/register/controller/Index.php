<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/15/2017
 * Time: 10:40 PM
 */

namespace app\register\controller;

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

    public function create()
    {
        $this->validatePostData([
            "username" => "require",
            "password" => "require"
        ]);
        UserModel::createUser($this->request->post("username"), $this->request->post("password"));
        $this->redirect("/login");
    }


}