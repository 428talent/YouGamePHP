<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/12/2017
 * Time: 8:08 PM
 */

namespace app\common\controller;


use app\common\model\AuthModel;
use think\Controller;
use think\Cookie;

class BaseController extends Controller
{
    protected $user = null;

    protected function _initialize()
    {
        parent::_initialize();
        $this->initUser();

    }

    public function index()
    {
        $this->fetch('index');
    }

    private function initUser()
    {
        $token_cookie = Cookie::get("token");
        if ($token_cookie == null) {
            return;
        }
        $auth = AuthModel::get(["token_key" => $token_cookie]);
        if ($auth == null) {
            return;
        }
//        $now_time = new \DateTime();
//        if ($auth->token_expire->getTimestamp() < $now_time->getTimestamp()) {
//            return;
//        }
        $this->user = $auth->user;
        $this->assign("user", $this->user);
    }

    protected function validatePostData(array $rule)
    {
        $result = $this->validate($this->request->post(), $rule);
        if (true !== $result) {
            $this->error($result);
        }
    }
}
