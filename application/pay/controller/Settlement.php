<?php
/**
 * Created by PhpStorm.
 * User: cqucc
 * Date: 17-12-18
 * Time: 下午3:48
 */

namespace app\pay\controller;


use app\common\controller\BaseController;
use app\common\model\OrderLogModel;
use app\common\model\OrderModel;

class Settlement extends BaseController
{
    public function index()
    {
        $this->validatePostData([
            "bill" => "require"
        ]);
        $order = OrderModel::get($this->request->post("bill"));
        if ($this->user->balance->amount < $order->price) {
            $this->error("余额不足");
        }
        OrderLogModel::create([
            "prev" => $this->user->balance->amount,
            "pay" => $order->price,
            "order_id" => $order->id,
        ]);
        $balance = $this->user->balance;
        $balance->amount -= $order->price;
        $balance->save();
        $this->redirect("/");
    }
}