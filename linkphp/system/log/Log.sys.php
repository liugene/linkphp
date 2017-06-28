<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                    系统日志类                     *
 * --------------------------------------------------*
 */

 namespace System\Log;
 class Log
 {
     static public function save($message)
     {
         static::write($message);
     }

     static private function write($message)
     {
         $time = date('c');
         $filename = date('Y-m-d');
         $logpath = C('LOG_PATH') . $filename . '-System-Log';
         if(!is_dir($logpath)){
             mkdir($logpath,0755,true);
         }
         error_log("[{$time}] ".$_SERVER['REMOTE_ADDR'].' '.$_SERVER['REQUEST_URI']."\r\n{$message}\r\n", 3,$logpath . '/' . $filename . '.log');
     }
 }


 ?>