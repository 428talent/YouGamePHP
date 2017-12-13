<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/9/2017
 * Time: 8:56 PM
 */

namespace app\admin\controller;


use think\Model;

abstract class AdminModelController extends BaseAdminController
{
    /**
     * 获取Model
     * @return Model 模型
     */
    public abstract function getModel();
    public function index()
    {
        $this->assign("modelList", $this->getModel()->select());
        return parent::index();
    }


}