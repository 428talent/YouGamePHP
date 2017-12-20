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
    protected function _initialize()
    {
        parent::_initialize();
        if (!$this->user->superuser) {
            $this->error("当前用户不是超级用户");
        }
    }

    public function getSideIndex()
    {
        return "permission";
    }

    public function getTitle()
    {
        return "权限";
    }

    public function index()
    {
        return parent::index();
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
