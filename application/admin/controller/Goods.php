<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/13/2017
 * Time: 8:28 PM
 */

namespace app\admin\controller;


use app\common\model\GameCategory;
use app\common\model\GameModel;
use DateTime;
use think\Model;

/**
 * 商品管理控制器
 * Class Goods
 * @package app\admin\controller
 *
 */
class Goods extends AdminModelController
{
    public function getSideIndex()
    {
        return "goods";
    }

    /**
     * 获取Model
     * @return Model 模型
     */
    public function getModel()
    {
        return new GameModel();
    }

    public function create()
    {
        $this->assign("category", GameCategory::all());
        return $this->fetch("create");
    }

    public function save()
    {
        $this->validatePostData([
            "name" => "require",
            "relese_time" => "require",
            "publisher" => "require",
            "price" => "require",
            "category" => "require",
            "detail" => "require"
        ]);

        $game = GameModel::create([
            "name" => $this->request->post("name"),
            "relese_time" => $this->request->post("relese_time") . " 00:00:00",
            "publisher" => $this->request->post("publisher"),
            "price" => $this->request->post("price"),
            "category_id" => $this->request->post("category"),
            "detail" => $this->request->post("detail")
        ]);
        $file = request()->file('icon');
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'imgs' . DS . 'game' . DS . $game->id, "cover");
            if ($info) {

                $game->icon = "/imgs/game/" . $game->id . "/" . $info->getFilename();
                $game->save();
            }
        }
//        $this->redirect("/admin/goods");
    }

}