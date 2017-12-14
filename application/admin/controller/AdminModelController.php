<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/9/2017
 * Time: 8:56 PM
 */

namespace app\admin\controller;


use think\Model;

/**
 * 模型类，快速建立Model
 * Class AdminModelController
 * @package app\admin\controller
 */
abstract class AdminModelController extends BaseAdminController
{
    /**
     * @var string[] 保存时获取的字段
     */
    private $saveField;
    /**
     * @var string 操作成功时重定向位置
     */
    private $actionRedirect;

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

    /**
     * 创建Model使用
     */
    public function save()
    {
        $data = [];
        foreach ($this->saveField as $field) {
            array_push($data, $this->request->post($field));
        }
        $model = $this->getModel();
        $model->save($data);
        $this->redirect($this->actionRedirect);
    }


}
