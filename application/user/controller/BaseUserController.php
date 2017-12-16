<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/16/2017
 * Time: 12:21 PM
 */

namespace app\user\controller;


use app\common\controller\BaseController;
use think\Controller;

class BaseUserController extends BaseController
{
    protected $sideNavIndex = 'home';

    protected function _initialize()
    {
        parent::_initialize();
        if ($this->user == null) {
            $this->redirect("/login");
        }
        $this->assign("sideNavIndex", $this->sideNavIndex);
    }

    protected function checkOwn()
    {

    }
}