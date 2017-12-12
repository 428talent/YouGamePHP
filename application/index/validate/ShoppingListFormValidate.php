<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/12/2017
 * Time: 8:39 PM
 */

namespace app\index\validate;


use think\Validate;

class ShoppingListFormValidate extends Validate
{
    protected $rule = [
        'game_id' => 'require'
    ];
}
