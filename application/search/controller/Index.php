<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/19/2017
 * Time: 7:42 PM
 */

namespace app\search\controller;


use app\common\controller\BaseController;
use app\common\model\GameModel;

class Index extends BaseController
{
    public function index()
    {
        $key = $this->request->param("key");
        $gamelist = (new GameModel())
            ->whereLike("name", "%" . $key, "OR")
            ->whereLike("name", $key . "%", "OR")
            ->whereLike("name", $key . "%" . $key, "OR")
            ->paginate(30);
        $this->assign("games", $gamelist);

        return $this->fetch("index");
    }
}