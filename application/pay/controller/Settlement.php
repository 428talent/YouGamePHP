<?php
/**
 * Created by PhpStorm.
 * User: cqucc
 * Date: 17-12-18
 * Time: 下午3:48
 */

namespace app\pay\controller;


use app\common\controller\BaseController;
use app\common\model\Inventory;
use app\common\model\OrderLogModel;
use app\common\model\Order;

class Settlement extends BaseController
{
    public function index()
    {
        $this->validatePostData([
            "bill" => "require"
        ]);
        $order = Order::get($this->request->post("bill"));
        //检查合计
        $totalPay = 0;

        foreach ($order->games as $game) {
            echo $game->good_name;
        }
        foreach ($order->games as $game) {
            $totalPay += $game->price;
            if ($totalPay > $this->user->balance->amount) {
                $this->error("余额不足");
            }
        }

        OrderLogModel::create([
            "prev" => $this->user->balance->amount,
            "pay" => $totalPay,
            "order_id" => $order->id,
        ]);
        $balance = $this->user->balance;
        $balance->amount -= $order->price;
        $balance->save();
        $order->state = 2;
        $order->save();
        foreach ($order->games as $game) {
            Inventory::create([
                "user_id" => $this->user->id,
                "game_id" => $game->good->id,
            ]);
        }
        $this->redirect("/");
    }
}