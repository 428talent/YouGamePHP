<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/17/2017
 * Time: 7:14 PM
 */

namespace app\admin\controller;


use app\common\model\GameCategory;
use think\Model;

class Category extends AdminModelController
{

    public function getSideIndex()
    {
        return "category";
    }

    /**
     * 获取Model
     * @return Model 模型
     */
    public function getModel()
    {
        return new GameCategory();
    }

    public function create()
    {
        $this->validatePostData([
            "name" => "require"
        ]);
        $name = $this->request->post("name");
        GameCategory::create([
            "name" => $name
        ]);
        $this->redirect("/admin/category");
    }
    public function delete(){
        $id = $this->request->param("id");
        GameCategory::destroy($id);
        $this->redirect("/admin/category");
    }
}