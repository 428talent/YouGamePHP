<?php
/**
 * Created by PhpStorm.
 * User: TakayamaAren
 * Date: 12/21/2017
 * Time: 11:58 PM
 */

namespace app\common\model;


use think\Model;

/**
 * Class OrderGood
 * @package app\common\model
 * @property int id ID
 * @property string good_name 商品名称
 * @property string price 商品价格
 */
class OrderGood extends Model
{
    protected $table="order_good";
    public function good(){
        return $this->hasOne("GameModel","id","good_id");
    }
}