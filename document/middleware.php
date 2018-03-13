<?php

use linkphp\Application;
//中间件使用

//框架中实现了6个中间件

//configure目录下middleware.php中间件配置文件中

return [

    'beginMiddleware'          => [
        \app\controller\main\Index::class,
        \app\controller\main\Test::class,
        \app\controller\main\First::class,
    ],

    'appMiddleware'            => [
        \app\controller\main\Index::class,
    ],

    'modelMiddleware'          => [
        \app\controller\main\Test::class,
    ],

    'controllerMiddleware'     => [
        \app\controller\main\Test::class,
    ],

    'actionMiddleware'         => [
        \app\controller\main\Test::class,
    ],

    'destructMiddleware'       => [
        \app\controller\main\Test::class,
    ],

];

//分别为 框架启动中间件、应用启动中间件、模块初始化中间件、控制器初始化中间件、方法调用中间件以及框架销毁前中间件

//使用中间件的类必须实现handle方法，接收一个闭包参数最后都必须把闭包赋值的变量做返回操作

use Closure;

class Index
{
    public function handle(Closure $next)
    {
        dump('middleware index');
        return $next;
    }
}

//闭包使用方法

Application::middleware('beginMiddleware',function (Closure $v) {
    $v();
    echo 3;
    return $v;
});


