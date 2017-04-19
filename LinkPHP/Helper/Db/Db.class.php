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
                 return new Helper\Db\Type\Mysql($config);
                 break;
             case 'sqlsrv':
                 return new Helper\Db\Type\Sqlsrv($config);
                 break;
         }
     }
 }