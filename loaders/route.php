<?php

return [
    //默认分发参数配置
    '__APP__'            => APPLICATION_PATH,
    'var_platform'       => 'p',      //默认传递模块名
    'var_controller'     => 'c',      //默认传递控制器名
    'var_action'         => 'a',      //默认传递方法名
    'default_platform'   => 'main',  //默认模块名
    'default_controller' => 'Home',  //默认控制器
    'default_action'     => 'main',  //默认操作方法
    'url_module'         => '1',      //URL模式 0普通模式 1 pathinfo模式 2 rewrite模式
    'route_rules_on'     => TRUE,
    'route_rules'        => array(
        '/Index/Index'   =>  '/Index/Api',
    ),
]

?>