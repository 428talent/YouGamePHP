<?php
/**
 * Created by IntelliJ IDEA.
 * User: TakayamaAren
 * Date: 12/8/2017
 * Time: 12:57 PM
 */

namespace app\login\controller;


use think\Controller;

class Index extends Controller
{
    public function index(){
        return $this->fetch("index");
    }
}
