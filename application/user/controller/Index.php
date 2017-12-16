<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/16/2017
 * Time: 12:24 AM
 */

namespace app\user\controller;

use app\common\controller\BaseController;

class Index extends BaseUserController
{
    function index()
    {
        return $this->fetch("index");
    }
}