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
use app\common\model\Inventory;
use app\common\model\OrderLogModel;
use app\common\model\Order;

class Index extends BaseController
{
    public function index()
    {
        $id = $this->request->param("id");
        $game = GameModel::get($id);
        if ($game == null || $game->enable == false) {
            return abort(404, '页面不存在');
        }
        $this->assign("game", $game);
        $model = new Order();
        $startMonthTime = date('Y-m-01', strtotime(date("Y-m-d")));
        $endMonthTime = date('Y-m-d', strtotime("$startMonthTime +1 month -1 day"));
        $monthlySellCount = (new Inventory())
            ->where("game_id", "=", $id)
            ->where('createAt', 'between time', [$startMonthTime, $endMonthTime])
            ->count();
        $totalSellCount = (new Inventory())
            ->where("game_id", "=", $id)
            ->count();;
        $totalCommentCount = 0;
        $this->assign("totalCommentCount", $totalCommentCount);
        $this->assign("totalSellCount", $totalSellCount);
        $this->assign("monthlySellCount", $monthlySellCount);
        $this->assign("bought", false);
        if ($this->user != null) {
            if (
                (new Inventory())
                    ->where("user_id", "=", $this->user->id)
                    ->where("game_id", "=", $id)
                    ->count() > 1
            ) {
                $this->assign("bought", true);
            }
        }
        return $this->fetch("index");
    }

    public function buy()
    {
        $id = $this->request->param("id");
        $game = GameModel::get($id);
        $order = new Order();
        $order->save([
            "user_id" => $this->user->id,
            "state" => 1,
            "price" => $game->price
        ]);

        $order->games()->save([
            "good_name" => $game->name,
            "price" => $game->price,
            "good_id" => $game->id
        ]);

        $this->redirect("/pay/" . $order->id);
    }
}