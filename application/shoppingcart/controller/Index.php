<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/16/2017
 * Time: 12:13 AM
 */

namespace app\shoppingcart\controller;

use app\common\controller\BaseController;
use app\common\model\ShoppingListModel;

class Index extends BaseController
{
    function index()
    {
        $cartItems = $this->user->shoppingList;
        $this->assign("cartItems", $cartItems);
        return $this->fetch("index");
    }

    public function add()
    {
        $this->validatePostData([
            "id" => "require"
        ]);
        ShoppingListModel::create([
            "game_id" => $this->request->post("id"),
            "user_id" => $this->user->id
        ]);
        $this->redirect("/game/" . $this->request->post("id"));
    }

    public function delete()
    {
        $id = $this->request->param("id");
        ShoppingListModel::destroy($id);
        $this->redirect("/shoppingcart");
    }
}