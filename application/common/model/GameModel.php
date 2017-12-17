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
 * Class GameModel
 * @package app\common\model
 * @property int id 游戏ID
 * @property string name 游戏名
 * @property string detail 游戏具体介绍
 * @property bool enable 游戏是否可用
 * @property string icon 游戏图标
 * @property float price 价格
 * @property \DateTime relese_time 游戏发行时间
 * @property string publisher 发行商
 * @property \DateTime createAt 创建时间
 * @property \DateTime updateAt 最后一次修改时间
 * @property GameCommentModel[] comments 游戏评论
 * @property GamePicModel[] pics 游戏宣传图
 */
class GameModel extends Model
{
    protected $table = "game";
    protected $autoWriteTimestamp = 'datetime';
    protected $createTime = "createAt";
    protected $updateTime = "updateAt";
    protected $readonly = ['createAt','updateAt'];
    protected static function init()
    {
        parent::init();
    }

    public function comments()
    {
        return $this->hasMany("GameCommentModel", "game_id");
    }

    public function pics()
    {
        return $this->hasMany("GamePicModel", "game_id");
    }
    public function category(){
        return $this->belongsTo("GameCategory","category_id");
    }

}
