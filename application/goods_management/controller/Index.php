<?php
/**
 * Created by PhpStorm.
 * User: ChaosMiscol
 * Date: 2017/12/9
 * Time: 9:21
 */
namespace app\goods_management\controller;


use think\Controller;

class Index extends Controller
{
    public function index(){
        return $this->fetch("index");
    }
    public function addGoods(){
        return $this->fetch("addGoods");
    }
    public function editGoods(){
        return $this->fetch("editGoods");
    }
    public function deleteGoods(){
        return $this->fetch("deleteGoods");
    }
}
