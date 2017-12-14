<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/9/2017
 * Time: 9:15 PM
 */

namespace app\admin\controller;


use app\common\model\GroupModel;
use app\common\model\UserModel;
use think\Model;

class Group extends AdminModelController
{
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

    /**
     * 获取Model
     * @return Model 模型
     */
    public function getModel()
    {
        return new GroupModel();
    }

    public function edit()
    {
        $id = $this->request->get("id");
        $this->assign("group", GroupModel::get(["id" => $id]));
        return $this->fetch("edit");

    }
}
