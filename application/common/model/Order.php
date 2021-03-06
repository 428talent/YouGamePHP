<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 2:32 PM
 */

namespace app\common\model;


use think\Model;

/**
 * Class OrderModel
 * @package app\common\model
 * @property int id 订单ID
 * @property int state 订单状态
 * @property GameModel game 游戏
 * @property UserModel user 用户
 * @property float price 应付价格
 * @property  \DateTime createAt 创建时间
 * @property  \DateTime updateAt 更新时间
 * @property OrderLogModel log 订单交易记录
 */
class Order extends Model
{
    protected $table = "order";
    protected $autoWriteTimestamp = 'datetime';
    protected $createTime = "createAt";
    protected $updateTime = "updateAt";
    protected $readonly = ['createAt', 'updateAt'];

    public function log()
    {
        return $this->hasOne("OrderLogModel", "order_id");
    }

    public function user()
    {
        return $this->belongsTo("UserModel", "user_id");
    }

    public function game()
    {
        return $this->belongsTo("GameModel", "game_id");
    }

    public function games()
    {
        return $this->belongsToMany("OrderGood", "order_m_good","good_id","order_id");
    }
}
