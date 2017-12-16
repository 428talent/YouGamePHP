<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/16/2017
 * Time: 8:26 PM
 */

namespace app\user\controller;


use app\common\model\OrderModel;

class Order extends BaseUserController
{
    public function index()
    {
        $orderList = OrderModel::all();
        $this->assign("orderList", $orderList);
        return $this->fetch("index");
    }
}