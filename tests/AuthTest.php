<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 6:03 PM
 */

namespace tests;


use app\common\model\AuthModel;
use app\common\model\UserModel;
use app\exceptions\UserExistException;
use think\exception\DbException;

class AuthTest extends TestCase
{


    public function testsExample()
    {


        try {
            UserModel::createUser("allen", "dzh17217");
        } catch (UserExistException $e) {

        }

    }

    public function testsLoginUser(){
       $this->assertEquals(2,1+1);
    }
}
