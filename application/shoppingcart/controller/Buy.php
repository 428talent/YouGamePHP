<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/22/2017
 * Time: 12:27 PM
 */

namespace app\shoppingcart\controller;


use app\common\controller\BaseController;
use app\common\model\GameModel;
use app\common\model\Order;
use app\common\model\ShoppingListModel;

class Buy extends BaseController
{
    public function index()
    {
        $this->validatePostData([
            "goods" => "require"
        ]);
        $goods = json_decode($this->request->post("goods"));
        $orderGameList = [];
        $totalPay = 0;
        foreach ($goods as $goodId) {
            $cartItem = ShoppingListModel::get($goodId);
            $totalPay += $cartItem->game->price;
            array_push($orderGameList, $cartItem->game);
        }
        $order = new Order();
        $order->save([
            "state" => 1,
            "price" => $totalPay,
            "user_id" => $this->user->id
        ]);
        foreach ($orderGameList as $game) {
            $order->games()->save([
                "good_name" => $game->name,
                "price" => $game->price,
                "good_id" => $game->id,
            ]);
        }

        foreach ($goods as $goodId) {
            ShoppingListModel::destroy($goodId);
        }
        $this->redirect("/pay/" . $order->id);
    }
}