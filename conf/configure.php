<?php

// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liugene <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               公共配置文件
// +----------------------------------------------------------------------


return [
    //'配置项' => '配置值'，

    //默认视图文件配置
    'default_temp_theme'   => 'default',
    'default_temp_type'    => '1', //默认模板引擎,0=>LinkPHP默认原生PHP,1=>Smarty模板引擎,2=>Links模板引擎
    'default_theme_suffix' => '.html',  //默认视图文件后缀
    'temp_cache'           => false, //是否开启模板缓存
    'set_left_limiter'     => '{',  //设置模板引擎左侧解析标签
    'set_right_limiter'    => '}',  //设置模板引擎右侧解析标签


    //扩展配置开关
    'extend_model_config'  => false,

    //系统语言包设置
    'default_language'     => 'cn', //设置系统语言'cn'简体中文,'tw'繁体中文,'en'英语。默认中文


    //站点调试
    'app_debug'            => true, //是否打开调试功能

    //系统安全配置
    'token_turn_on'        => false, //是否打开表单令牌验证

    //系统常用路径设置
    'log_path'             => CACHE_PATH  . 'log/', //系统日志存储路径

];

