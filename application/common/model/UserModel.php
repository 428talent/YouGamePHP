<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 1:08 PM
 */

namespace app\common\model;


use app\exceptions\UserExistException;
use think\Config;
use think\Db;
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
 * @property Order[] orders 用户订单
 * @property bool superuser 超级用户
 */
class UserModel extends Model
{
    protected $table = "user";

    /**
     * 创建用户
     * @param $username string 用户名
     * @param $password string 原始密码
     * @throws UserExistException 用户已存在
     * @throws \think\exception\DbException 数据库错误
     */
    public static function createUser($username, $password)
    {
        if (UserModel::get(["username" => $username]) != null) {
            throw new UserExistException();
        }
        $password = sha1(md5(Config::get('salt') . $password));
        self::create([
            "username" => $username,
            "password" => $password
        ]);
    }

    public function inventory()
    {
        return $this->hasMany("Inventory", "user_id");
    }

    public function checkPassword($password)
    {
        return $this->password == sha1(md5(Config::get('salt') . $password));
    }

    public function profile()
    {
        return $this->hasOne("ProfileModel", "user_id");
    }

    /**
     * 查询用户是否有权限
     * @param string $action 权限名
     * @return bool 是否拥有权限
     */
    public function hasPermission($action)
    {
        $result = Db::query("SELECT permission.*
FROM (
       SELECT user_group.*
       FROM (
              SELECT *
              FROM user
              WHERE user.id = 4
            ) AS u, user_user_group, user_group
       WHERE
         u.id = user_user_group.user_id AND
         user_user_group.user_group_id = user_group.id

     ) AS g, user_group_permission, permission
WHERE
  g.id = user_group_permission.user_group_id AND
  user_group_permission.permission_id = permission.id AND
    permission.action =:action_name", ["action_name" => $action]);
        return $result != null;
    }


    public function permissions()
    {
        return $this->hasManyThrough("PermissionModel", "GroupModel", "user_id", "permission_id", "user_group_id");
    }

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
        return $this->hasMany("Order", "user_id");
    }

    public function groups()
    {
        $this->belongsToMany("GroupModel", "user_user_group", "user_group_id", "user_id");
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
        $enPassword = sha1(md5(Config::get('salt') . $password));
        $user = UserModel::get(["username" => $username, "password" => $enPassword]);
        if ($user != null) {
            $user->last_login = date("y-m-d h:i:s");
            $user->save();
        }
        return $user;
    }

}
