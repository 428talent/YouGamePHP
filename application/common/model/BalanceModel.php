<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 1:11 PM
 */

namespace app\common\model;


use think\Model;

/**
 * Class BalanceModel
 * @package app\common\model
 * @property float amount 账户余额
 * @property \DateTime last_update 上一次变余额
 * @property UserModel user 账户用户
 */
class BalanceModel extends Model
{
    protected $table = "balance";

    public function user()
    {
        return $this->hasOne("UserModel", "user_id");
    }
}
