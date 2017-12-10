<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/10/2017
 * Time: 12:54 PM
 */

namespace app\index\controller;


use app\common\model\OrderModel;
use think\Controller;
use think\Cookie;
use app\common\util\OrderState;

class Order extends Controller
{
    public function index()
    {
        return "<h1>订单页面</h1>";
    }

    public function create()
    {
        $game = $this->request->post("game_id");
        $user = Cookie::get("token");
        OrderModel::create([
            "game_id" => $game,
            "user_id" => $user,
            "state" => OrderState::created,
            "createAt" => date("y-m-d h:i:s")
        ]);
    }
}
