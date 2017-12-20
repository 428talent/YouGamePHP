<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/18/2017
 * Time: 8:08 PM
 */

namespace app\detail\controller;


use app\admin\controller\Orderlog;
use app\common\controller\BaseController;
use app\common\model\GameCommentModel;
use app\common\model\GameModel;
use app\common\model\OrderLogModel;
use app\common\model\OrderModel;

class Index extends BaseController
{
    public function index()
    {
        $id = $this->request->param("id");
        $game = GameModel::get($id);
        if ($game == null || $game->enable == false){
            return abort(404,'页面不存在');
        }
        $this->assign("game", $game);
        $model = new OrderModel();
        $startTime = date("Y-m-d H:i:s", strtotime("-1 month"));
        $endTime = date("Y-m-d H:i:s");
        $monthlySellCount = $model
            ->whereBetween("createAt", "${startTime},${endTime}")
            ->where("game_id", "=", $this->request->param("id"))
            ->where("state", "=", 2)
            ->count();
        $totalSellCount = $model
            ->where("game_id", "=", $this->request->param("id"))
            ->where("state", "=", 2)
            ->count();
        $totalCommentCount  = (new GameCommentModel())
            ->where("game_id","=",$this->request->param("id"))
            ->count();
        $this->assign("totalCommentCount",$totalCommentCount);
        $this->assign("totalSellCount",$totalSellCount);
        $this->assign("monthlySellCount", $monthlySellCount);
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