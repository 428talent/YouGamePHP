<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 1:19 PM
 */

namespace app\common\model;


use think\Config;
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
    protected $table = "auth";

    public function user()
    {
        $this->belongsTo("UserModel", "user_id");
    }

    /**
     * 生成授权码
     * @param $userId int 用户ID
     * @return string 授权码
     * @throws \think\exception\DbException
     */
    public function generateAuth($userId)
    {
        $user = UserModel::get($userId);
        $key = md5($user->username . $user->id . Config::get("salt"));
        if ($user->auth == null) {
            AuthModel::create([
                "user_id" => $user->id,
                "token_key" => $key,
                "expire" => date("y-m-d h:i:s", strtotime("+1 week")),
                "createAt" => date("y-m-d h:i:s")
            ]);
        } else {
            $user->auth->update([
                "token_key" => $key,
                "expire" => date("y-m-d h:i:s", strtotime("+1 week")),
                "createAt" => date("y-m-d h:i:s")
            ], [
                "user_id" => $user->id
            ]);
        }
        return $key;
    }
}
