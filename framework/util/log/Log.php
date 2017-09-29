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

 namespace util\log;
 class Log
 {

     //保存日志存储大小
     static private $_log_size = 1048576;

     //设置日志保存大小
     static public function setLogSize($size)
     {
         if(is_numeric($size)){
             self::$_log_size = $size;
         }
     }

     static public function save($message)
     {
         static::write($message);
     }

     //存储操作日志内容
     static private function write($message,$path=null)
     {
         $time = date('c');
         $data = date('Y-m-d');
         $logpath = is_null($path) ? C('log_path') . $data : $path;
         $reslpath = str_replace('\\','/',$logpath);
         if(!is_dir($reslpath)){
             mkdir($reslpath,0755,true);
         }
         $filename = $reslpath . '/' . $data;
         if(file_exists($filename) && filesize($filename) >= self::$_log_size){
             $i = 0;
             $filename = rename($filename,$reslpath . '/' . $data . '-' . $i++  . '.json');
         }
         error_log("[{$time}] ".$_SERVER['REMOTE_ADDR'].' '.$_SERVER['REQUEST_URI']."\r\n{$message}\r\n", 3, $filename . '.log');
     }
 }


