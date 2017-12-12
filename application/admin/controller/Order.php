<?php
/**
 * Created by IntelliJ IDEA.
 * User: cqucc
 * Date: 17-12-9
 * Time: 上午10:06
 */

namespace app\admin\controller;


use app\common\model\OrderModel;
use think\Model;

class Order extends AdminModelAdminController
{
    public function getSideIndex()
    {
        return "order";
    }

    public function getTitle()
    {
        return "订单";
    }


    /**
     * 获取Model
     * @return Model 模型
     */
    public function getModel()
    {
        return new OrderModel();
    }
}
