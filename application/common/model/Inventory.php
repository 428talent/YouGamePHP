<?php
/**
 * Created by IntelliJ IDEA.
 * User: cqucc
 * Date: 17-12-9
 * Time: 上午9:20
 */

namespace app\common\model;


use think\Model;

/**
 * Class Inventory
 * @package app\common\model
 * @property int id 库存ID
 * @property GameModel game 游戏
 * @property UserModel user 用户
 * @property \DateTime createAt 创建时间
 */
class Inventory extends Model
{
    protected $table = "inventory";

    public function game()
    {
        return $this->hasOne("GameModel", "game_id");
    }

    public function user()
    {
        return $this->hasOne("UserModel", "user_id");
    }
}