<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                 LinkPHP框架入口文件               *
 * --------------------------------------------------*
 */
 
 //类文件后缀常量
 const EXT = '.class.php';
 //声明路径常量
 //目录基础常量的定义
 define('ROOT_PATH',getCWD() . '/');
 define('APPLICATION_PATH', ROOT_PATH . 'App/');
 //定义缓存目录常量
 define('CACHE_PATH', ROOT_PATH . 'Cache/');
 //定义公共附件目录常量
 define('__PUBLIC__', ROOT_PATH . 'Public/');
 //定义LinkPHP框架目录常量
 define('LINKPHP_PATH', ROOT_PATH . 'LinkPHP/');
 //定义LinkPHP框架核心类目录常量
 define('CORE_PATH', LINKPHP_PATH . 'Link/');
 //定义LinkPHP框架语言目录常量
 define('LANG_PATH', LINKPHP_PATH . 'Lang/');
 //定义LinkPHP框架公共函数目录常量
 define('FUNCTION_PATH', LINKPHP_PATH . 'Function/');
 //定义LinkPHP框架公共配置目录常量
 define('CONF_PATH', LINKPHP_PATH . 'Conf/');
 //定义LinkPHP框架应用公共配置目录常量
 define('APPCONF_PATH', ROOT_PATH . 'Config/');
 //定义LinkPHP框架扩展类库目录常量
 define('EXTEND_PATH', LINKPHP_PATH . 'Extend/');
 //定义LinkPHP框架附件目录常量
 define('TTFF_PATH',LINKPHP_PATH . 'TTFF/');

 //系统可变常量
 defined('CREATE_SQLVI_ON') or define('CREATE_SQLVI_ON','FALSE'); //开启视图索引创建
 defined('APP_DEBUG') or define('APP_DEBUG','FALSE'); //开启站点调试
 defined('SYSTEM_LANGUAGE') or define('SYSTEM_LANGUAGE','');
 
 
 //加载LinkPHP框架核心初始化类
 require CORE_PATH . 'LinkPHP' . EXT;
 Link\Link::start();


?>