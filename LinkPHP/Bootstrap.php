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
  * 加载LinkPHP框架核心初始化类
  */
 require CORE_PATH . 'LinkPHP' . EXT;
 Link\Link::start();