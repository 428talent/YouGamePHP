<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 1:16 PM
 */

namespace app\common\model;


use think\Model;

/**
 * Class ProfileModel
 * @package app\common\model
 * @property string nickname 昵称
 * @property string avatar 头像
 * @property string email 邮箱
 * @property string phone 手机
 * @property UserModel user 用户
 */
class ProfileModel extends Model
{
    protected $table = 'profile';

    public function user()
    {
        return $this->belongsTo("UserModel", "user_id");
    }

}
