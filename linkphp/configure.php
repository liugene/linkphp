<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                   公共配置文件                    *
 * --------------------------------------------------*
 */

 
 return [
  //'配置项' => '配置值'，
  //数据库默认配置
   'host'     => 'localhost', //一般不需要修改
   'port'     => '3306', //默认即可
   'dbuser'   => '', //数据库用户名
   'dbpwd'    => '', //数据库密码
   'charset'  => 'utf8', //数据库编码
   'dbname'   => '', //数据库名称
   'dbprefix' => '', //数据库表前缀
   'db_type'  => 'sqlsrv', //数据库类型 默认Mysql
  
  //默认分发参数配置
  'var_platform'       => 'p',      //默认传递模块名
  'var_controller'     => 'c',      //默认传递控制器名
  'var_action'         => 'a',      //默认传递方法名
  'default_platform'   => 'Index',  //默认模块名
  'default_controller' => 'Index',  //默认控制器
  'default_action'     => 'index',  //默认操作方法
  'url_module'         => '1',      //URL模式 0普通模式 1 pathinfo模式 2 rewrite模式
  
  
  //默认视图文件配置
  'default_temp_theme'   => 'default',
  'default_temp_type'    => '2', //默认模板引擎,0=>LinkPHP默认原生PHP,1=>Smarty模板引擎,2=>Links模板引擎
  'default_theme_suffix' => '.html',  //默认视图文件后缀
  'temp_cache'           => 'false', //是否开启模板缓存
  'set_left_limiter'     => '<{',  //设置模板引擎左侧解析标签
  'set_right_limiter'    => '}>',  //设置模板引擎右侧解析标签
  
  
  //扩展配置开关
  'extend_model_config'  => 'false',

  //系统语言包设置
  'default_language'     => 'cn', //设置系统语言'cn'简体中文,'tw'繁体中文,'en'英语。默认中文
  
  
  //站点调试
  'app_debug'            => 'true', //是否打开调试功能

  //系统安全配置
  'token_turn_on'        => 'false', //是否打开表单令牌验证

  //系统引擎配置
  'session_on'           => 'true', //是否开启SESSION机制

  //系统常用路径设置
  'log_path'             => CACHE_PATH  . 'log/', //系统日志存储路径

  //命名空间注册
  'autoload_namespace'   =>  [
       'assets\main\controllers'        =>  array(APPLICATION_PATH . 'main/controllers'),
       'assets\main\models'             =>  array(APPLICATION_PATH . 'main/models'),
       'assets\base\models'              =>  array(APPLICATION_PATH . 'base/models'),
       'assets\base\controllers'         =>  array(APPLICATION_PATH . 'base/controllers'),
       'linkphp\bootstrap'               =>  array(LINKPHP_PATH . 'bootstrap'),
  ]

 ];


?>
