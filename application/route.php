<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::rule("game/:id", 'game/Index/index');
Route::rule("admin/goods/detail/:id", "admin/Goods/detail");
Route::rule("admin/goods/edit/:id", "admin/Goods/edit");
Route::rule("pay/:id$", "pay/Index/index");
Route::rule("pay/:id/settlement$", "pay/Settlement/index");
Route::rule("game/:id$", "detail/Index/index");
Route::rule("game/:id/buy$", "detail/Index/buy");
Route::rule("/admin/order/log","admin/orderlog/index");
Route::get("/admin/order/:id","admin/order/detail",[],["id"=>"\d+"]);
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]' => [
        ':id' => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],


];
