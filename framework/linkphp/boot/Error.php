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


class Error
{

    /**
     * 一般错误页面
     */
    static private $normal_view;

    /**
     * 致命错误页面
     */
    static private $fatal_view;

    /**
     * 异常错误页面
     */
    static private $exception_view;

    static private $_instance;

    static public function instance()
    {
        if(is_null(self::$_instance)) self::$_instance = new self();

        return self::$_instance;
    }

    /**
     * 设置错误处理相关配置
     * @param Object Error $error
     * @return Object Error $error
     */
    static public function set(Error $error)
    {
        return $error;
    }

    /**
     * 设置一般错误页面
     * @param string $view
     * @return Object $this
     */
    public function setNormalView($view)
    {
        self::$normal_view = $view;
        return $this;
    }

    /**
     * 设置致命错误页面
     * @param string $view
     * @return Object $this
     */
    public function setFatalView($view)
    {
        self::$fatal_view = $view;
        return $this;
    }

    /**
     * 设置异常错误页面
     * @param string $view
     * @return Object $this
     */
    public function setExceptionView($view)
    {
        self::$exception_view = $view;
        return $this;
    }

    public function getNormalView()
    {
        return self::$normal_view;
    }

    public function getFatalView()
    {
        return self::$fatal_view;
    }

    public function getExceptionView()
    {
        return self::$exception_view;
    }

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
        require(self::$normal_view);
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
                require(self::$fatal_view);
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
        require(self::$exception_view);
        die;
    }

}
