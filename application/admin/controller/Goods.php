<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/13/2017
 * Time: 8:28 PM
 */

namespace app\admin\controller;


use app\common\model\GameModel;
use think\Model;

/**
 * 商品管理控制器
 * Class Goods
 * @package app\admin\controller
 *
 */
class Goods extends AdminModelController
{
    public function getSideIndex()
    {
        return "goods";
    }

    /**
     * 获取Model
     * @return Model 模型
     */
    public function getModel()
    {
        return new GameModel();
    }

    public function create()
    {
        return $this->fetch("create");
    }
}