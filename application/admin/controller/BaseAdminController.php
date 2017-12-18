<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 12:49 PM
 */


/**
 * Class BaseController
 * @package app\admin\controller
 * Admin 基类，用于定义通用方法.
 * 所有的Admin页面控制器必须继承此方法
 */

namespace app\admin\controller;

use app\common\controller\BaseController;

abstract class BaseAdminController extends BaseController
{
    protected function _initialize()
    {
        parent::_initialize();
        if($this->user == null){
            $this->redirect("/login");
        }
        $this->assign("sideIndex", $this->getSideIndex());
        $this->assign("title", $this->getTitle());

    }
    public function getTitle(){
        return "YouGame";
    }
    /**
     * 用于设定标签名称，管理页面侧边导航激活状态
     * @return string 当前标签名称
     */
    public function getSideIndex()
    {
        return "Home";
    }

    public function index()
    {

        return $this->fetch("index");
    }
}
