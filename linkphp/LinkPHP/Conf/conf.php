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

 
 return array(
  //'配置项' => '配置值'，
  //数据库默认配置
   'HOST'     => 'localhost', //一般不需要修改
   'PORT'     => '3306', //默认即可
   'DBUSER'   => '', //数据库用户名
   'DBPWD'    => '', //数据库密码
   'CHARSET'  => 'utf8', //数据库编码
   'DBNAME'   => '', //数据库名称
   'DBPREFIX' => '', //数据库表前缀
  
  //默认分发参数配置
  'VAR_PLATFORM'       => 'p',      //默认传递模块名
  'VAR_CONTROLLER'     => 'c',      //默认传递控制器名
  'VAR_ACTION'         => 'a',      //默认传递方法名
  'DEFAULT_PLATFORM'   => 'Index',  //默认模块名
  'DEFAULT_CONTROLLER' => 'Index',  //默认控制器
  'DEFAULT_ACTION'     => 'index',  //默认操作方法
  
  
  //默认视图文件配置
  'DEFAULT_TEMP_THEME'   => 'Default',
  'DEFAULT_TEMP_TYPE'    => '0', //默认模板引擎,0=>LinkPHP默认原生PHP,1=>Smarty模板引擎
  'DEFAULT_THEME_SUFFIX' => 'html',  //默认视图文件后缀 
  'TEMP_CACHE'           => 'FALSE', //是否开启模板缓存
  
  
  //扩展配置开关
  'EXTEND_MODEL_CONFIG'  => 'FALSE',
  
  
  //站点调试
  'APP_DEBUG'            => 'TRUE', //是否打开调试功能

 );



?>