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

    //站点调试
    'app_debug'            => ENV::get('app.debug', true), //是否打开调试功能

    //系统安全配置
    'token_turn_on'        => false, //是否打开表单令牌验证

    //系统常用路径设置
    'log_path'             => CACHE_PATH  . 'log/', //系统日志存储路径

    'default_return_type' => 'view', //view json console xml jsonp

    'dispatch_error_tmpl'  => 'tpl/dispatch_jump',

];

