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
  
  //默认视图文件配置
  'default_temp_theme'   => 'default',
  'default_temp_type'    => '1', //默认模板引擎,0=>LinkPHP默认原生PHP,1=>Smarty模板引擎,2=>Links模板引擎
  'default_theme_suffix' => '.html',  //默认视图文件后缀
  'temp_cache'           => false, //是否开启模板缓存
  'set_left_limiter'     => '<{',  //设置模板引擎左侧解析标签
  'set_right_limiter'    => '}>',  //设置模板引擎右侧解析标签
  
  
  //扩展配置开关
  'extend_model_config'  => false,

  //系统语言包设置
  'default_language'     => 'cn', //设置系统语言'cn'简体中文,'tw'繁体中文,'en'英语。默认中文

  
  //站点调试
  'app_debug'            => true, //是否打开调试功能

  //系统安全配置
  'token_turn_on'        => false, //是否打开表单令牌验证

  //系统引擎配置
  'session_on'           => true, //是否开启SESSION机制

  //系统常用路径设置
  'log_path'             => CACHE_PATH  . 'log/', //系统日志存储路径

  //第三方平台接口配置
   'alidayu_appkey'        =>  '23470347',
   'alidayu_appsecret'     =>  '393f29267c68f9c3a1eeac93af5cc8b7',
   'alidayu_sign_name'     =>  'linkphp框架',
   'alidayu_phone_number'  =>  '13879337614',
   'alidayu_sms_id'        =>  'SMS_78400009',
   'alidayu_sms_param'           =>  '',

 ];

