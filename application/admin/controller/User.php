<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/9/2017
 * Time: 10:33 PM
 */

namespace app\admin\controller;


use app\common\model\UserModel;
use think\Model;

class User extends AdminModelController
{

    /**
     * 获取Model
     * @return Model 模型
     */
    public function getModel()
    {
        return new UserModel();
    }
}
