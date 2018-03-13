<?php
use linkphp\Application;
//路由使用

//在configure目录下route.php路由配置文件中进行配置使用

return [
    '/main/home/main'   =>  function(\linkphp\router\Router $router){
        return '/main/home/main';
    },
];

//键名为当前请求的路径
//键值接收字符串或者闭包函数


//闭包使用方法

Application::router('index/getUser',function(){
    return 1;
});
