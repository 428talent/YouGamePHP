<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 12:36 PM
 */

namespace app\admin\controller;


use app\common\model\GameModel;
use app\common\model\OrderLogModel;
use app\common\model\OrderModel;
use app\common\model\UserModel;
use think\Controller;

class Index extends BaseAdminController
{
    public function test()
    {
        return "test";
    }

    public function index()
    {
        $today = date("y-m-d");
        $totalSellToday = (new OrderModel())
            ->whereBetween("updateAt", $today . " 00:00:00," . $today . " 23:59:59")
            ->where("state", "=", 2)
            ->count();
        $topSellToday = (new OrderModel())
            ->field("*,count(game_id) as sellCount")
            ->whereBetween("updateAt", $today . " 00:00:00," . $today . " 23:59:59")
            ->where("state", "=", 2)
            ->group("game_id")
            ->order("sellCount", "DESC")
            ->limit(10)
            ->select();

        $newUserToday = (new UserModel())
            ->whereBetween("createAt", $today . " 00:00:00," . $today . " 23:59:59")
            ->count();
        $incomeToday = (new OrderLogModel())
            ->whereBetween("createAt", $today . " 00:00:00," . $today . " 23:59:59")
            ->sum("pay");
        $newGame = (new GameModel())
            ->order("createAt", "DESC")
            ->limit(10)
            ->select();
        $this->assign("newUserToday", $newUserToday);
        $this->assign("incomeToday", $incomeToday);
        $this->assign("totalSellToday", $totalSellToday);
        if (count($topSellToday) != 0) {
            $this->assign("topSellToday", $topSellToday[0]);
        }
        $this->assign("todaySell", $topSellToday);
        $this->assign("newGames", $newGame);
        return $this->fetch("index");
    }
}
