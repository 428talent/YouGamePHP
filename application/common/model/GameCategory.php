<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 2:34 PM
 */

namespace app\common\model;


use think\Model;

/**
 * Class GameCategory
 * @package app\common\model
 * @property int id 分类ID
 * @property string name 分类名称
 * @property \DateTime createAt 创建时间
 * @property GameModel[] games 分类下的游戏
 */
class GameCategory extends Model
{
    protected $table="game_category";
    public function games()
    {
        return $this->hasMany("GameModel", "category_id");
    }
}
