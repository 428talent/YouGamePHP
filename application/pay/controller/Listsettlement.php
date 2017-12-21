<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/21/2017
 * Time: 9:21 PM
 */

namespace app\pay\controller;


use app\common\controller\BaseController;
use app\common\model\GameModel;
use app\common\model\Inventory;
use app\common\model\OrderLogModel;
use app\common\model\OrderModel;
use app\common\model\ShoppingListModel;
use think\response\Json;

class Listsettlement extends BaseController
{
    function index()
    {
        $jsonGoods = $this->request->post("goods");
        $goods = json_decode($jsonGoods);
        $payGoods = [];
        $currentPrice = 0;
        foreach ($goods as $itemId) {
            $item = ShoppingListModel::get($itemId);
            $currentPrice += $item->game->price;
            if ($this->user->balance->amount < $currentPrice) {
                $this->error("账户余额不足以支付所选商品");
            }
            array_push($payGoods, $item);
        }
        foreach ($payGoods as $item) {
            $order = new OrderModel();
            $order->save([
                "state" => 2,
                "game_id" => $item->game->id,
                "user_id" => $this->user->id,
                "price" => $item->game->price
            ]);
            OrderLogModel::create([
                "prev" => $this->user->balance->amount,
                "pay" => $order->price,
                "order_id" => $order->id
            ]);
            $this->user->balance->amount -= $order->price;
            Inventory::create([
                "user_id" => $this->user->id,
                "game_id" => $order->game->id
            ]);
            ShoppingListModel::destroy($item->id);

        }
        $this->redirect("/user/inventory");
    }
}