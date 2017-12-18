<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/18/2017
 * Time: 8:08 PM
 */

namespace app\detail\controller;


use app\common\controller\BaseController;
use app\common\model\GameModel;
use app\common\model\OrderModel;

class Index extends BaseController
{
    public function index()
    {
        $id = $this->request->param("id");
        $this->assign("game", GameModel::get($id));
        return $this->fetch("index");
    }

    public function buy()
    {
        $id = $this->request->param("id");
        $game = GameModel::get($id);
        $order = OrderModel::create([
            "game_id" => $id,
            "user_id" => $this->user->id,
            "state" => 1,
            "price" => $game->price
        ]);
        $this->redirect("/pay/" . $order->id);
    }
}