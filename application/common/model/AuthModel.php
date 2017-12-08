<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 1:19 PM
 */

namespace app\common\model;


use think\Model;

/**
 * Class AuthModel
 * @package app\common\model
 * @property int id 授权ID
 * @property string token_key 授权Key
 * @property \DateTime expire 授权过期日期
 * @property \DateTime createAt 授权生成日期
 * @property UserModel user 授权的用户
 */
class AuthModel extends Model
{
    protected $table="auth";
    public function user(){
        $this->belongsTo("UserModel","user_id");
    }
}