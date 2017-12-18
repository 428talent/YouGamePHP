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
 * Class OrderLogModel
 * @package app\common\model
 * @property int id 订单记录ID
 * @property float prev 交易前的账户余额
 * @property float pay 支付的金额
 * @property \DateTime createAt 创建时间
 * @property OrderModel logOrder 订单
 */
class OrderLogModel extends Model
{
    protected $table = "order_log";
    protected $autoWriteTimestamp = 'datetime';
    protected $createTime = 'createAt';
    protected $updateTime = false;

    public function logOrder()
    {
        return $this->belongsTo("OrderModel", "order_id");
    }
}
