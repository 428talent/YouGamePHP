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


    public function index()
    {

        return $this->fetch("index");
    }
}
