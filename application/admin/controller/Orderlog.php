<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/18/2017
 * Time: 7:47 PM
 */

namespace app\admin\controller;


use app\common\model\OrderLogModel;
use think\Model;

class Orderlog extends AdminModelController
{
    public function getSideIndex()
    {
        return "order_log";
    }

    /**
     * 获取Model
     * @return Model 模型
     */
    public function getModel()
    {
        return new OrderLogModel();
    }
}