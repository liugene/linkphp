<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                 LinkPHP框架分发类               *
 * --------------------------------------------------*
 */

 namespace Link;
 class Dispatch
 {

     //分发类构造函数
     public function __construct()
     {
         $this->_dispatch();
     }

     //分发方法
     private function _dispatch()
     {
         //实例化控制器类
         $controller_name = PLATFORM . '\\' . 'Controller' . '\\' . CONTROLLER . 'Controller';
         //实例化
         $controller = new $controller_name();
         //调用方法
         $action_name = ACTION;
         $controller -> $action_name();
     }
 }

?>