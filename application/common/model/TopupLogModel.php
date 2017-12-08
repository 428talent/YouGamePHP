<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 1:16 PM
 */

namespace app\common\model;


use think\Model;

/**
 * Class TopupLogModel
 * @package app\common\model
 * @property float money 充值的金额
 * @property float prev 充值前的金额
 * @property \DateTime createAt 记录创建时间
 * @property UserModel user 对应的用户
 */
class TopupLogModel extends Model
{
    protected $table="topup_log";
    public function user(){
        return $this->belongsTo("UserModel","user_id");
    }
}
