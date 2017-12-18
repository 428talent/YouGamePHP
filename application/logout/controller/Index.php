<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/18/2017
 * Time: 12:44 PM
 */

namespace app\logout\controller;


use app\common\controller\BaseController;
use think\Cookie;

class Index extends BaseController
{
    public function index()
    {
        Cookie::delete("token");
        $this->redirect("/login");
    }
}