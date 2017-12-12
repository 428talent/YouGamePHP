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

class Permission extends AdminModelAdminController
{
    public function getSideIndex()
    {
        return "permission";
    }

    public function getTitle()
    {
        return "权限";
    }

    /**
     * 获取Model
     * @return Model 模型
     */
    public function getModel()
    {
        return new PermissionModel();
    }
}
