<?php

use linkphp\Application;

//接收两个参数，第一个参数为标签，第二个参数可以一组类的数组也可以为类名

Application::event(
    'test',
    [
        \app\controller\main\Event::class,
        \app\controller\main\Event::class,
        \app\controller\main\Event::class
    ]
);

//事件类必须实现EventServerProvider接口中update，该方法接收EventDefinition对象参数，在update方法最后将其赋值给的变量做返回操作

use linkphp\event\EventDefinition;
use linkphp\event\EventServerProvider;

class Event implements EventServerProvider
{
    public function update(EventDefinition $definition)
    {
        dump(2);
        return $definition;
        // TODO: Implement update() method.
    }
}

//事件触发

Application::event('test');

//在不给定第二个参数时则认定为触发操作

//事件配置使用方法

//在框架的configure目录下有个event.php事件配置文件

return [
    //事件标签
    //'server' => [
        //执行事件类
    //  '\app\controller\main\Event::class';
    //]
//    'test' => [
//        '\app\controller\main\Event::class',
//    ]
];

