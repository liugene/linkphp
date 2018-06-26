<?php

use linkphp\http\HttpRequest;

//路由中间件
$event = [
    \linkphp\router\middleware\TestProvider::class
];

//设置路由中间件
app()->event('routerMiddleware', $event);

//Router::get('/', function(HttpRequest $httpRequest){
//    view('main/home/main',[
//        'linkphp' => 'linkphp'
//    ]);
//});

Router::get(':id/:test', function($id, $test, HttpRequest $httpRequest){
//    dump($id);
//    dump($httpRequest);
    return "闭包路由,不走实例控制器,直接闭包返回的结果。接收到的参数id:" . $id . ",test:".$test;
});
Router::ws('chat','/app/ws/Handle#ws');
//Router::get('addons', '/addons/test/Test@main');
Router::get('addons/:plugin', '/linkphp/addons/Bootstrap@boot', [], ['plugin' => '/[\s\S]*/']);
Router::get('/', '/http/home/main');

return [
//    ':id/:test'   =>  ['/http/home/main',['method' => 'get']],
];