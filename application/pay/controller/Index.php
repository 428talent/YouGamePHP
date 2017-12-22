<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/18/2017
 * Time: 1:40 PM
 */

namespace app\pay\controller;


use app\common\controller\BaseController;
use app\common\model\GameModel;
use app\common\model\OrderLogModel;
use app\common\model\Order;

class Index extends BaseController
{
    public function index()
    {

        $this->assign("order", Order::get($this->request->param("id")));
        return $this->fetch("index");
    }

    /**
     * 资金结算
     */
    public function settlement()
    {

    }
}