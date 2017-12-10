<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/9/2017
 * Time: 11:03 PM
 */

namespace tests;

namespace tests;
use app\common\model\UserModel;

class PermissionTest extends TestCase
{
    public function testPermissionCheck()
    {
        $user = UserModel::get(["id" => 4]);
        $hasPerm = $user->hasPermission("DELETE_GAME");
        $this->assertEquals(false, $hasPerm);
    }
}
