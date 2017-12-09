<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 6:43 PM
 */

namespace app\exceptions;


use Exception;

class UserExistException extends Exception
{
    protected $message = "用户已存在";
}
