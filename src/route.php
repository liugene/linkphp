<?php

use linkphp\http\HttpRequest;

Router::get(':id/:test', function(HttpRequest $httpRequest,$id){
    dump($id);
    dump($httpRequest);
    return '闭包路由';
});
//Router::get(':id/:test', '/addons/test/Test@main');
Router::get('/', '/http/home/main');

return [
//    ':id/:test'   =>  ['/main/home/main',['method' => 'get']],
];