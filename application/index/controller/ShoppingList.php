<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/12/2017
 * Time: 8:35 PM
 */

namespace app\index\controller;


use app\common\controller\BaseController;
use app\common\model\ShoppingListModel;

class ShoppingList extends BaseController
{
    public function add()
    {
        if ($this->user == null) {
            $this->error("请登录后操作");
        }
        $result = $this->validate($this->request->post(), 'ShoppingListFormValidate');
        if (true !== $result) {
            $this->error("提交信息错误");
        }
        ShoppingListModel::create([
            "game_id" => $this->request->post("game_id"),
            "user_id" => $this->user->id,
            "createAt" => date("y-m-d h:i:s")
        ]);
        $this->redirect("/");
    }

    public function delete()
    {
        //是否登录
        if ($this->user == null) {
            $this->error("请登录后操作");
        }


        $result = $this->validate($this->request->post(), 'ShoppingListDeleteFormValidate');
        if (true !== $result) {
            $this->error("提交信息错误");
        }

        $game = ShoppingListModel::get($this->request->post("id"));
        //是否为本人
        if ($game->user->id != $this->user->id) {
            $this->error("非法操作");
        }

        $game->delete();

        $this->redirect("/");

    }
}
