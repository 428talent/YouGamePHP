<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/16/2017
 * Time: 12:13 AM
 */

namespace app\shoppingcart\controller;

use app\common\controller\BaseController;

class Index extends BaseController
{
    function index()
    {
        return $this->fetch("index");
    }
}