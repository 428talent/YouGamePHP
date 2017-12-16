<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/17/2017
 * Time: 12:54 AM
 */

namespace app\game\controller;


use app\common\controller\BaseController;
use app\common\model\GameModel;

class Index extends BaseController
{
    function index()
    {
        $this->assign("game",GameModel::get($this->request->param("id")));
        return $this->fetch("index");
    }
}