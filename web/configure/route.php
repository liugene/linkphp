<?php

return [
    //默认分发参数配置
    '__APP__'            => ROOT_PATH . '/root/',
    'VAR_PLATFORM'       => 'p',      //默认传递模块名
    'VAR_CONTROLLER'     => 'c',      //默认传递控制器名
    'VAR_ACTION'         => 'a',      //默认传递方法名
    'DEFAULT_PLATFORM'   => 'index',  //默认模块名
    'DEFAULT_CONTROLLER' => 'Index',  //默认控制器
    'DEFAULT_ACTION'     => 'index',  //默认操作方法
    'URL_MODULE'         => '1',      //URL模式 0普通模式 1 pathinfo模式 2 rewrite模式
    'ROUTE_RULES_ON'     => 'TRUE',
    'ROUTE_RULES'        => array(
        '/Index/Index'   =>  '/Index/Api',
    ),
]

?>