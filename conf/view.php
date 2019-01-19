<?php

return [//默认视图文件配置
    'default_temp_theme'   => 'default',
    'default_theme_suffix' => '.html',  //默认视图文件后缀
    'temp_cache'           => false, //是否开启模板缓存
    'set_left_limiter'     => '<{',  //设置模板引擎左侧解析标签
    'set_right_limiter'    => '}>',  //设置模板引擎右侧解析标签
    'view_replace_str'     => [],

    // 模板路径
    'view_path'    => '',

    'storage_drive'        => 'File',
    'cache_time'           => '1800',
    'tpl_replace_string'   => []
];