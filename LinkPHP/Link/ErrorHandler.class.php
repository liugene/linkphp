<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *            LinkPHP框架自定义错误处理器            *
 * --------------------------------------------------*
 */

 class ErrorHandler{
   
    
    /**
     * 自定义错误处理方法
     * @param [string] $error 错误级别
     * @param [string] $msg 错误信息
     * @param [string] $filename 错误文件
     * @param [string] $line 错误行
     */
   static public function linkErrorFunc($error,$msg,$filename,$line){

        switch($error){
            //错误级别：提醒
            case E_NOTICE:
            case E_USER_NOTICE:
            $error_type = 'NOTICE';
            break;
            
            //错误级别：警告
            case E_WARNING:
            case E_USER_WARNING:
            $error_type = 'WARNING';
            break;
            
            //错误级别：致命错误
            case E_ERROR:
            case E_USER_ERROR:
            return static::dealError();
            break;
            default:
            $error_type='UNKNOWN ERROR';
            return FALSE;
            break;
        }
        $datatime = date('Y-m-d H:i:s',time());
        $message = <<<EOT
        出现{$error_type}错误:<br />
        产生{$error_type}错误文件:{$filename}<br />
        产生{$error_type}错误信息:{$msg}<br />
        产生{$error_type}错误信息行:{$line}<br />
        产生错误时间:{$datatime}<br />
        
EOT;
        require TTFF_PATH . 'temp/error' . '.' . C('DEFAULT_THEME_SUFFIX');
        die;
    }

     static public function dealError()
     {
         return false;
     }
 }



?>