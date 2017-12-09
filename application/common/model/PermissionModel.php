<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/9/2017
 * Time: 8:39 PM
 */

namespace app\common\model;


use think\Model;

/**
 * Class PermissionModel
 * @package app\common\model
 * @property int id 权限ID
 * @property string name 权限名称
 * @property string action 权限操作
 */
class PermissionModel extends Model
{
    protected $table = "permission";

    public function groups()
    {
        return $this->belongsToMany("GroupModel", "user_group_permission", "permission_id");
    }
}
