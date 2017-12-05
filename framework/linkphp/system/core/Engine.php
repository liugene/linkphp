<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *               LinkPHP系统引擎机制                 *
 * --------------------------------------------------*
 */

 namespace linkphp\system\core;
 class Engine
 {
     static public function initialize()
     {
         /**
          * 开启session机制
          */
         if(C('session_on')){
             session_start();
         }
     }
 }


 ?>