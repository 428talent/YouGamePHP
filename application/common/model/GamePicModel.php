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
 * Class GamePicModel
 * @package app\common\model
 * @property int id 游戏宣传图ID
 * @property string url 图片路径
 * @property GameModel game 游戏
 */
class GamePicModel extends Model
{
    protected $table = "game_pic";

    public function game()
    {
        return $this->belongsTo("GameModel", "game_id");
    }

}
