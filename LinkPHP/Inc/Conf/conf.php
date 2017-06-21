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
   'HOST'     => 'localhost', //一般不需要修改
   'PORT'     => '3306', //默认即可
   'DBUSER'   => '', //数据库用户名
   'DBPWD'    => '', //数据库密码
   'CHARSET'  => 'utf8', //数据库编码
   'DBNAME'   => '', //数据库名称
   'DBPREFIX' => '', //数据库表前缀
   'DB_TYPE'  => 'sqlsrv', //数据库类型 默认Mysql
  
  //默认分发参数配置
  'VAR_PLATFORM'       => 'p',      //默认传递模块名
  'VAR_CONTROLLER'     => 'c',      //默认传递控制器名
  'VAR_ACTION'         => 'a',      //默认传递方法名
  'DEFAULT_PLATFORM'   => 'Index',  //默认模块名
  'DEFAULT_CONTROLLER' => 'Index',  //默认控制器
  'DEFAULT_ACTION'     => 'index',  //默认操作方法
  'URL_MODULE'         => '1',      //URL模式 0普通模式 1 pathinfo模式 2 rewrite模式
  
  
  //默认视图文件配置
  'DEFAULT_TEMP_THEME'   => 'Default',
  'DEFAULT_TEMP_TYPE'    => '2', //默认模板引擎,0=>LinkPHP默认原生PHP,1=>Smarty模板引擎,2=>Links模板引擎
  'DEFAULT_THEME_SUFFIX' => '.html',  //默认视图文件后缀
  'TEMP_CACHE'           => 'FALSE', //是否开启模板缓存
  'SET_LEFT_LIMITER'     => '<{',  //设置模板引擎左侧解析标签
  'SET_RIGHT_LIMITER'    => '}>',  //设置模板引擎右侧解析标签
  
  
  //扩展配置开关
  'EXTEND_MODEL_CONFIG'  => 'FALSE',

  //系统语言包设置
  'DEFAULT_LANGUAGE'     => 'cn', //设置系统语言'cn'简体中文,'tw'繁体中文,'en'英语。默认中文
  
  
  //站点调试
  'APP_DEBUG'            => 'TRUE', //是否打开调试功能

  //系统安全配置
  'TOKEN_TURN_ON'        => 'FALSE', //是否打开表单令牌验证

  //系统引擎配置
  'SESSION_ON'           => 'TRUE', //是否开启SESSION机制

  //数据库扩展支持
  'CREATE_SQLVI_ON'      => 'TRUE', //是否开启视图索引创建功能，默认开启

  //系统常用路径设置
  'LOG_PATH'             => CACHE_PATH  . 'Log/', //系统日志存储路径

  //命名空间注册
  'AUTOLOAD_NAMESPACE'   =>  [
       'App\Index\Controller'        =>  array(APPLICATION_PATH . 'Index/Controller'),
       'App\Index\Model'             =>  array(APPLICATION_PATH . 'Index/Model'),
       'App\Common\Model'            =>  array(APPLICATION_PATH . 'Common/Model'),
       'App\Common\Controller'       =>  array(APPLICATION_PATH . 'Common/Controller'),
       'App\Common\SQLVI'            =>  array(APPLICATION_PATH . 'Common/SQLVI'),
  ]

 ];



?>
