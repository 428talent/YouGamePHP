<?php
/**
 * Created by IntelliJ IDEA.
 * User: cqucc
 * Date: 17-12-9
 * Time: 上午9:48
 */

namespace app\common\model;


use think\Model;

/**
 * Class GroupModel
 * @package app\common\model
 * @property int id 用户组ID
 * @property string group_name 用户组名称
 * @property UserModel[] users 用户组的用户
 * @property PermissionModel[] permissions 用户组的权限
 */
class GroupModel extends Model
{
    protected $table = "user_group";

    public function users()
    {
        return $this->belongsToMany("UserModel", "user_user_group", "user_id", "user_group_id");
    }

    public function permissions()
    {
        return $this->belongsToMany("PermissionModel", "user_group_permission", "permission_id", "user_group_id");
    }
}
