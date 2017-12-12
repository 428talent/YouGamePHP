<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/12/2017
 * Time: 7:26 PM
 */

namespace app\login\validate;


use think\Validate;

class LoginFormValidate extends Validate
{
    protected $rule = [
        'username' => 'require|max:16',
        'password' => 'require'
    ];
}
