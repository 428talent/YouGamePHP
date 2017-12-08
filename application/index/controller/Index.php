<?php
namespace app\index\controller;

use think\Db;

class Index
{
    public function index()
    {
        Db::table("user")->insert(["username"=>"test","password"=>"test"]);
        return "index";
    }
}
