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
 
 namespace linkphp\system\db;
 use linkphp\system\db\drives\Mysql;
 use linkphp\system\db\drives\Sqlsrv;
 class Drives
 {

     /**
      * 检测数据库类型
      */
     static public function init($config){
         switch($config['db_type']){
             case 'mysql':
                 return new Mysql($config);
                 break;
             case 'sqlsrv':
                 return new Sqlsrv($config);
                 break;
         }
     }
 }