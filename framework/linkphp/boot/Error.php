<?php

namespace linkphp\boot;
// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liugene <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               配置类
// +----------------------------------------------------------------------

use linkphp\boot\handle\LoadClassException;

class Error
{

    //错误处理类注册
    static public function register()
    {
        // 报告所有错误
        error_reporting(E_ALL);
        /**
         * 捕获致命错误自定义处理方法
         */
        register_shutdown_function([__CLASS__,'dealFatalError']);

        /**
         * 捕获普通自定义处理方法
         */
        set_error_handler([__CLASS__,'dealNormalError']);

        /**
         * 捕获异常自定义处理方法
         */
        set_exception_handler([__CLASS__,'dealException']);
    }


    /*
     * 自定义错误处理方法
     * @param [string] $error 错误级别
     * @param [string] $msg 错误信息
     * @param [string] $filename 错误文件
     * @param [string] $line 错误行
     **/
    static public function dealNormalError($error,$msg,$filename,$line){

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
            default:
                $error_type='UNKNOWN ERROR';
                return FALSE;
                break;
        }
        $datetime = date('Y-m-d H:i:s',time());
        $message = <<<EOT
        <B>出现{$error_type}错误&nbsp:</B><br /><br />
        <B>产生{$error_type}错误文件&nbsp:</B> &nbsp&nbsp {$filename}<br /><br />
        <B>产生{$error_type}错误信息&nbsp:</B> &nbsp&nbsp {$msg}<br /><br />
        <B>产生{$error_type}错误信息行&nbsp:</B> &nbsp&nbsp {$line}

EOT;
        //ob_start();
        //header("Content-type:text/html;charset=utf-8");
        //ob_end_flush();

        require(EXTRA_PATH . 'tpl/error' . C('default_theme_suffix'));
        die;
    }

    /**
     * 致命错误捕获
     * */
    static public function dealFatalError()
    {
        $error = error_get_last();
        $trace = debug_backtrace();
        switch($error['type']){
            //错误级别：致命错误
            case E_PARSE:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_ERROR:
            case E_USER_ERROR:
                $error_type='Fatal Error';
                $datetime = date('Y-m-d H:i:s',time());
                $message = <<<EOT
        <B>出现{$error_type}错误&nbsp:</B><br /><br />
        <B>产生{$error_type}错误文件&nbsp:</B> &nbsp&nbsp {$error['file']}<br /><br />
        <B>产生{$error_type}错误信息&nbsp:</B> &nbsp&nbsp {$error['message']}<br /><br />
        <B>产生{$error_type}错误信息行&nbsp:</B> &nbsp&nbsp {$error['line']}<br /><br />
        <B>错误跟踪&nbsp:</B> &nbsp&nbsp <br /><br />
        类名&nbsp: &nbsp&nbsp {$trace[0]['class']}<br /><br />
        方法名&nbsp: &nbsp&nbsp {$trace[0]['function']}<br /><br />
        调用类型&nbsp: &nbsp&nbsp {$trace[0]['type']}

EOT;
                //ob_start();
                //header("Content-type:text/html;charset=utf-8");
                //ob_end_flush();
                require(EXTRA_PATH . 'tpl/fatalerror' . C('default_theme_suffix'));
                die;
                break;
        }
    }

    /**
     *自定义异常错误处理函数
     */
    static public function dealException($e)
    {
        $datetime = date('Y-m-d H:i:s',time());
        $info = $e->getMessage();
        $trace = $e->getTraceAsString();
        $line = $e->getLine();
        $file = $e->getFile();
        $message = <<<EOT
        <B>{$info}错误&nbsp:</B><br /><br />
        <B>产生{$info}错误文件&nbsp:</B> &nbsp&nbsp {$file}<br /><br />
        <B>产生{$info}错误信息行&nbsp:</B> &nbsp&nbsp {$line}

EOT;
        //ob_start();
        //header("Content-type:text/html;charset=utf-8");
        //ob_end_flush();
        require EXTRA_PATH . 'tpl/Exception' . C('default_theme_suffix');
        die;
    }

}
