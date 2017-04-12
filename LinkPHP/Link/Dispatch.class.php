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
     static public function run()
     {
         static::_dispatch();
     }

     //分发方法
     static private function _dispatch()
     {
         $dir = APPLICATION_PATH . PLATFORM . '/' . 'Controller';
         //判断模块是否存在
         if(!is_dir($dir)){
             //抛出异常
             throw new \Exception("无法加载模块");
         }
         //实例化控制器类
         $controller_name = PLATFORM . '\\' . 'Controller' . '\\' . CONTROLLER . 'Controller';
         $filename = APPLICATION_PATH . PLATFORM . '/' . 'Controller' . '/' . CONTROLLER . 'Controller' . EXT;
         if(file_exists($filename)){
             $controller = new $controller_name();
         } else {
             //抛出异常
             throw new \Exception("无法加载控制器");
         }
         //调用方法
         $action_name = ACTION;
         if(method_exists($controller,$action_name)){
             $controller -> $action_name();
         } else {
             //抛出异常
             throw new \Exception("无法加载方法");
         }
     }
 }

?>