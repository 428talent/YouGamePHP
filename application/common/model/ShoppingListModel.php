<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 1:18 PM
 */

namespace app\common\model;


use think\Model;

/**
 * Class ShoppingListModel
 * @package app\common\model
 * @property int id ID
 * @property GameModel game 游戏
 * @property UserModel user 用户
 * @property \DateTime createAt 创建时间
 */
class ShoppingListModel extends Model
{
    protected $table = 'shopping_list';
    protected $autoWriteTimestamp = 'datetime';
    protected $createTime = 'createAt';
    protected $updateTime = false;

    public function game()
    {
        return $this->belongsTo("GameModel", "game_id");
    }

    public function user()
    {
        return $this->belongsTo("UserModel", 'user_id');

    }
}
