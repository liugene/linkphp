<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                 LinkPHP框架启动文件               *
 * --------------------------------------------------*
 */

 /**
  * 加载Composer自动加载
  */
 require VENDOR_PATH . 'autoload.php';

 /**
  * 引入H.php助手类
  */
 require HELPER_PATH . 'H' . EXT;

 /**
  * 注册助手类自动加载方法
  */
 H::register('helperNamespace');

 /**
  * 引入S.php系统内部类
  */
 require LINKPHP_PATH . 'System/' . 'S' . EXT;

 /**
  * 注册系统内部类自动加载方法
  */
 S::register('systemrNamespace');

 /**
  * 引入Q.php系统内部类
  */
 require LINKPHP_PATH . 'Q' . EXT;

 /**
  * 注册系统内部类自动加载方法
  */
 Q::register('ORMNamespace');

 /**
  * 加载LinkPHP框架核心初始化类
  */
 require CORE_PATH . 'LinkPHP' . EXT;
 Link\Link::start();