<?php
/**
 * Created by IntelliJ IDEA.
 * User: cqucc
 * Date: 17-12-9
 * Time: 上午9:48
 */

namespace app\common\model;


use think\Model;

class GroupModel extends Model
{
    public function users(){
        return $this->belongsToMany("UserModel");
    }
}