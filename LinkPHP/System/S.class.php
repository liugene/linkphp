<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                     系统内部类                    *
 * --------------------------------------------------*
 */

 class S
 {
     static public function register($namespace)
     {
         //注册助手类自动加载
         spl_autoload_register(array(__CLASS__,$namespace));
     }
     static private function systemrNamespace($classname)
     {
         if($classname == 'S'){
             $filename = LINKPHP_PATH . 'System/' . $classname . EXT;
             //判断文件是否存在
             if(file_exists($filename)){
                 //存在引入
                 //第三方扩展类库Extend/Library 目录下面的命名空间自动定位
                 require LINKPHP_PATH  . 'System/' . $classname . EXT;
             } else {
                 //不存在
                 //抛出异常
                 throw new \Exception("无法加载系统内部类");
             }
         }
     }
     static public function name()
     {
         echo 123;
     }
 }


?>