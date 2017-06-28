<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *               LinkPHP系统视图索引                 *
 * --------------------------------------------------*
 */

 namespace System\SQL;
 use Common\SQLVI\CVSQLVI;
 use Common\SQLVI\CISQLVI;
 class SQLVI
 {
     static public function run()
     {
         if(CREATE_SQLVI_ON == 'TRUE'){
             CVSQLVI::run();
             CISQLVI::run();
         }
     }
 }

 ?>