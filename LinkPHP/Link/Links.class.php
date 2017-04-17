<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                   Links初始化类                  *
 * --------------------------------------------------*
 */

 namespace Link;
 class Links
 {
     private $_links;

     public function __construct()
     {
         require LINKPHP_PATH . 'Template/Links/Links' . EXT;
         $this->_links = new \Links();
     }

     /**
      * Links模板引擎初始化方法
      */
     public function init()
     {
         $this->_links->display();
     }

     /**
      * 模板赋值
      * */
     public function assign($name,$value)
     {
         $this->_links->assign($name,$value);
     }
 }