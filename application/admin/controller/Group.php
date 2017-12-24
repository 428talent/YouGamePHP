<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/9/2017
 * Time: 9:15 PM
 */

namespace app\admin\controller;


use app\common\model\GroupModel;
use app\common\model\PermissionModel;
use app\common\model\UserModel;
use think\Model;

class Group extends AdminModelController
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
        return "user_group";
    }

    public function getTitle()
    {
        return "用户组";
    }

    public function create()
    {
        $result = $this->validate($this->request->post(), [
            "name" => "require"
        ]);
        if (true !== $result) {
            $this->error($result);
        }

        GroupModel::create([
            "group_name" => $this->request->post("name")
        ]);

        $this->redirect('/admin/group');
    }

    public function save()
    {
        $this->validatePostData([
            "name" => "require"
        ]);
        GroupModel::create([
            "group_name" => $this->request->post("name")
        ]);
        $this->redirect("/admin/group");

    }

    public function addpermission()
    {
        $this->validatePostData([
            "pid" => "require",
            "gid" => "require"
        ]);
        $model = GroupModel::get($this->request->post("gid"));
        $permission = PermissionModel::get($this->request->post("pid"));
        if ($permission == null) {
            $this->error("权限不存在");
        }
        $model->permissions()->save($permission->id);
        $this->redirect("/admin/group/edit?id=" . $model->id);
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
        return new GroupModel();
    }

    public function deletepermission()
    {
        $pid = $this->request->param("pid");
        $gid = $this->request->param("gid");
        $model = GroupModel::get($gid);
        $model->permissions()->detach($pid);
        $this->redirect("/admin/group/edit?id=" . $model->id);
    }
    public function adduser(){
        $uid = $this->request->param("uid");
        $gid = $this->request->param("gid");
        $model = GroupModel::get($gid);
        $model->users()->save($uid);
        $this->redirect("/admin/group/edit?id=" . $model->id);
    }

    public function deleteuser(){
        $uid = $this->request->param("uid");
        $gid = $this->request->param("gid");
        $model = GroupModel::get($gid);
        $model->users()->detach($uid);
        $this->redirect("/admin/group/edit?id=" . $model->id);
    }

    public function edit()
    {
        $this->assign("permissionList", PermissionModel::all());
        $this->assign("userList", UserModel::all());
        $id = $this->request->get("id");
        $this->assign("group", GroupModel::get(["id" => $id]));
        return $this->fetch("edit");

    }
}
