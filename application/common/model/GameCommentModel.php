<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 2:33 PM
 */

namespace app\common\model;


use think\Model;

/**
 * Class GameCommentModel
 * @package app\common\model
 * @property int id 评论ID
 * @property int state 评价（好评，差评)
 * @property string content 评论内容
 * @property bool enable 可用
 * @property int positive 点赞数
 * @property int negative 反对数
 * @property \DateTime createAt 创建时间
 * @property \DateTime updateAt 最后一次更新时间
 * @property GameModel game 游戏
 * @property UserModel user 评论的用户
 */
class GameCommentModel extends Model
{
    protected $table = "comment";

    public function game()
    {
        return $this->belongsTo("GameModel", "game_id");
    }

    public function user()
    {
        return $this->belongsTo("UserModel", "user_id");
    }
}
