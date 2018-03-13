<?php

//依赖注入实现

//controller 层构造方法注入

namespace app\controller\main;

use linkphp\http\HttpRequest;
use linkphp\Application;

class Home
{
    public function __construct(HttpRequest $httpRequest)
    {
        dump($httpRequest);
    }
}

//通过浏览器请求到该控制器会将HttpRequest自动注入进Home控制器中

//自行手动注入  闭包注入实现
Application::singleton(
    'envmodel',
    function(){
        //自行操作最后返回一个实例对象
        return Application::get('test');
    });

//自行手动注入  类名注入
Application::singletonEager(
    'run',
    'linkphp\console\Command'
);

//获取类实例
Application::get('test');

//通过类名获取时,如果在容器内未找到实例会执行自动实例操作并返回,自动实例也会触发自动注入，如果实例对象存在依赖类会自动进行注入
Application::get('linkphp\console\Command');


Application::bind(
    Application::definition()
        ->setAlias('test')
        ->setIsEager(true)
        ->setIsSingleton(true)
        ->setClassName('classname')
);

Application::bind(
    Application::definition()
        ->setAlias('test')
        ->setIsEager(true)
        ->setIsSingleton(true)
        ->setCallBack('callback')
);
