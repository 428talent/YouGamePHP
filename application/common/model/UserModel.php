<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 1:08 PM
 */

namespace app\common\model;


use think\Model;

/**
 * Class UserModel
 * User 用户模型类
 * @package app\common\model
 * @property int $id 用户ID
 * @property string $username 用户名
 * @property \DateTime $last_login 上一次登录时间
 * @property BalanceModel $balance 账户余额
 * @property AuthModel $auth 用户认证
 * @property ShoppingListModel[] $shoppingList 用户购物车
 * @property GameCommentModel[] comments 用户评论
 * @property OrderModel[] orders 用户订单
 */
class UserModel extends Model
{
    protected $table = "user";

    public function auth()
    {
        return $this->hasOne("AuthModel", "user_id");
    }

    public function balance()
    {
        return $this->hasOne("BalanceModel", "user_id");
    }

    public function shoppingList()
    {
        return $this->hasMany("ShoppingListModel", "user_id");
    }

    public function comments()
    {
        return $this->hasMany("GameCommentModel", "user_id");
    }

    public function orders()
    {
        return $this->hasMany("OrderModel", "user_id");
    }

    public function groups()
    {
        $this->belongsToMany("GroupModel");
    }

    /**
     * 检查用户登录
     * @param $username string 密码
     * @param $password string 用户名
     * @return null|static 用户存在|不存在返回null
     * @throws \think\exception\DbException
     */
    public static function UserLogin($username, $password)
    {
        $user = UserModel::get(["username" => $username, "password" => $password]);
        if ($user != null) {
            $user->last_login = date("y-m-d h:i:s");
            $user->save();
        }

        return $user;
    }

}
