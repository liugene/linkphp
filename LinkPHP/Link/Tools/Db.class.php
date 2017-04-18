<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *               LinkPHP框架数据库操作类             *
 * --------------------------------------------------*
 */

 class Db
 {

     /**
      * 检测数据库类型
      */
     static public function run($config){
         switch(C('DB_TYPE')){
             case 'mysql':
                 new Helper\Db\Mysql($config);
                 break;
             case 'Sqlsrv':
                 new Helper\Db\Sqlsrv($config);
                 break;
         }
     }
 }