<?php
/**
 * Created by PhpStorm.
 * User: cqucc
 * Date: 17-12-20
 * Time: 上午9:19
 */

namespace app\common\model;


use think\Model;

/**
 * 首页轮播设置
 * Class IndexBannerCarousel
 * @package app\common\model
 */
class IndexBannerCarousel extends Model
{
    public function game()
    {
        return $this->belongsTo("GameModel", "game_id");
    }
}