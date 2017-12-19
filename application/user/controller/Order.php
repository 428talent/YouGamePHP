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
    protected $sideNavIndex = "order";
    public function index()
    {
        $orderList = $this->user->orders;
        $notPay = array_filter($orderList, function (OrderModel $order): bool {
            return $order->state == 1;
        });
        $payed = array_filter($orderList, function (OrderModel $order): bool {
            return $order->state == 2;
        });
        $this->assign("orderList", $orderList);
        $this->assign("notPayList", $notPay);
        $this->assign("payedList", $payed);
        return $this->fetch("index");
    }
}