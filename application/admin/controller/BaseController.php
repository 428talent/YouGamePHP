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
 */

namespace app\admin\controller;

use think\Controller;
use think\Model;

abstract class BaseController extends Controller
{
    protected function _initialize()
    {
        parent::_initialize();
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
