<?php

return [//默认视图文件配置
    'default_temp_theme'   => 'default',
    'default_temp_type'    => '1', //默认模板引擎,0=>LinkPHP默认原生PHP,1=>Smarty模板引擎,2=>Links模板引擎
    'default_theme_suffix' => '.html',  //默认视图文件后缀
    'temp_cache'           => false, //是否开启模板缓存
    'set_left_limiter'     => '{',  //设置模板引擎左侧解析标签
    'set_right_limiter'    => '}',  //设置模板引擎右侧解析标签
];