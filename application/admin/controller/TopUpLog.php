<?php
/**
 * Created by PhpStorm.
 * User: cqucclab
 * Date: 2017/12/14
 * Time: 16:15
 */

namespace app\admin\controller;


use app\common\model\TopupLogModel;
use think\Model;

class TopUpLog extends AdminModelController
{

    /**
     * 获取Model
     * @return Model 模型
     */
    public function getModel()
    {
        return new TopupLogModel();
    }
}