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

 namespace LinkSystem\Core;
 class Engine
 {
     static public function run()
     {
         /**
          * 开启session机制
          */
         if(C('SESSION_ON')){
             session_start();
         }
     }
 }


 ?>