<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/12/2017
 * Time: 8:49 PM
 */

namespace app\index\validate;


use think\Validate;

class ShoppingListDeleteFormValidate extends Validate
{
    protected $rule = [
        "id" => 'require'
    ];
}
