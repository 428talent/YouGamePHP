<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 12:36 PM
 */

namespace app\admin\controller;


use app\common\model\GameModel;
use app\common\model\Inventory;
use app\common\model\OrderLogModel;
use app\common\model\Order;
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
        $totalSellToday = (new Inventory())
            ->whereBetween("createAt", $today . " 00:00:00," . $today . " 23:59:59")
            ->count();
        $topSellToday = (new Inventory())
            ->field("*,COUNT(*) AS sellCount")
            ->whereBetween("createAt", $today . " 00:00:00," . $today . " 23:59:59")
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
