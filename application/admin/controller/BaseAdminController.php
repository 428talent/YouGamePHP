<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 12:49 PM
 */


/**
 * Class BaseController
 * @package app\admin\controller
 * Admin 基类，用于定义通用方法.
 * 所有的Admin页面控制器必须继承此方法
 */

namespace app\admin\controller;

use app\common\controller\BaseController;
use app\common\model\PermissionModel;

abstract class BaseAdminController extends BaseController
{
    protected function _initialize()
    {
        parent::_initialize();
        if($this->user == null){
            $this->redirect("/login");
        }
        if ($this->user->staff == false and $this->user->superuser == false){
            $this->error("没有权限","/");
        }
        $this->assign("sideIndex", $this->getSideIndex());
        $this->assign("title", $this->getTitle());

    }
    public function getTitle(){
        return "YouGame";
    }
    /**
     * 用于设定标签名称，管理页面侧边导航激活状态
     * @return string 当前标签名称
     */
    public function getSideIndex()
    {
        return "home";
    }

    public function index()
    {

        return $this->fetch("index");
    }
    public function checkUserpermission($name){
        $permission = new PermissionModel();
        $result = $permission->query("SELECT count(*) AS pcount
FROM permission, (
                   SELECT *
                   FROM user_group_permission, (
                                                 SELECT user_group.id AS m_group_id
                                                 FROM user_group, (
                                                                    SELECT user_group_id AS m_user_group_id
                                                                    FROM user_user_group
                                                                    WHERE user_id = :uid
                                                                  ) u_m_g
                                                 WHERE u_m_g.m_user_group_id = user_group.id
                                               ) g_m_p
                   WHERE g_m_p.m_group_id = user_group_permission.user_group_id
                 ) m_permission
WHERE m_permission.permission_id = permission.id AND
      permission.action = :permission_action",["permission_action"=>$name,"uid"=>$this->user->id]);
        if ($result[0]['pcount'] == 0){
            $this->error("没有权限");
        }
    }
}
