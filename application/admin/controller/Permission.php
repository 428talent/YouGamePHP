<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/9/2017
 * Time: 8:35 PM
 */

namespace app\admin\controller;


use app\common\model\PermissionModel;
use think\Model;

class Permission extends AdminModelController
{

    /**
     * 获取Model
     * @return Model 模型
     */
    public function getModel()
    {
        return new PermissionModel();
    }
}
