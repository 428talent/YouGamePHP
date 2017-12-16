<?php

namespace app\index\controller;

use app\common\controller\BaseController;
use app\common\model\GameModel;
use think\Controller;

class Index extends BaseController
{
    public function index()
    {
        $gameList = GameModel::all();
        $this->assign("gameList", $gameList);
        return $this->fetch('index');

    }

    public function login()
    {
        return $this->fetch('./static/index/index.html');
    }

    public function register()
    {
        return $this->fetch('./static/index/register.html');
    }

    public function option()
    {
        return $this->fetch('./static/index/option.html');
    }

    public function shopCart()
    {
        return $this->fetch('./static/index/shopCart.html');
    }

    public function person()
    {
        return $this->fetch('./static/index/person/index.html');
    }

    public function introduction()
    {
        return $this->fetch('./static/index/introduction.html');
    }
}