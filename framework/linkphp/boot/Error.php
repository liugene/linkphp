<?php

// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liugene <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               错误处理
// +----------------------------------------------------------------------

namespace linkphp\boot;

use linkphp\boot\exception\Handle;


class Error
{

    /**
     * 一般错误页面
     */
    static private $error_view;

    static private $_instance;

    static private $debug = true;

    /**
     * 错误行号
     */
    static private $line;

    /**
     * 错误文件
     */
    static private $file;

    /**
     * 错误信息
     */
    static private $message;

    /**
     * 错误类型
     */
    static private $error_type;

    /**
     * 出现错误类
     */
    static private $class;

    /**
     * 出现错误方法
     */
    static private $function;

    /**
     * 出现错误调用类型
     */
    static private $type;

    /**
     * 异常实例对象
     */
    static private $exception;

    /**
     * 错误时间
     */
    static private $timestamp;

    /**
     * 异常追踪
     */
    static private $trace;

    static private $error_handle;

    public function setException($e)
    {
        self::$exception = $e;
        return $this;
    }

    public function getException()
    {
        return self::$exception;
    }

    public function setTimestamp($time)
    {
        self::$timestamp = $time;
        return $this;
    }

    public function setTrace($trace)
    {
        self::$trace = $trace;
        return $this;
    }

    public function setLine($line)
    {
        self::$line = $line;
        return $this;
    }

    public function setFile($file)
    {
        self::$file = $file;
        return $this;
    }

    public function setMessage($message)
    {
        self::$message = $message;
        return $this;
    }

    public function setErrorType($type)
    {
        self::$error_type = $type;
        return $this;
    }

    public function setClass($class)
    {
        self::$class = $class;
        return $this;
    }

    public function setFunction($function)
    {
        self::$function = $function;
        return $this;
    }

    public function setType($type)
    {
        self::$type = $type;
        return $this;
    }

    public function setDebug($bool)
    {
        self::$debug = $bool;
        return $this;
    }

    public function setErrHandle($handle)
    {
        self::$error_handle = $handle;
        return $this;
    }

    public function getErrHandle()
    {
        return self::$error_handle;
    }

    public function getLine()
    {
        return self::$line;
    }

    public function getFile()
    {
        return self::$file;
    }

    public function getMessage()
    {
        return self::$message;
    }

    public function getErrorType()
    {
        return self::$error_type;
    }

    public function getClass()
    {
        return self::$class;
    }

    public function getFunction()
    {
        return self::$function;
    }

    public function getType()
    {
        return self::$type;
    }

    public function getTimestamp()
    {
        return self::$timestamp;
    }

    public function getTrace()
    {
        return self::$trace;
    }

    public function getDebug()
    {
        return self::$debug;
    }

    static public function instance()
    {
        if(is_null(self::$_instance)) self::$_instance = new self();

        return self::$_instance;
    }

    /**
     * 设置错误处理相关配置
     * @param Object Error $error
     * @return Error Object
     */
    static public function register(Error $error)
    {
        return $error;
    }

    /**
     * 设置一般错误页面
     * @param string $view
     * @return Error Object
     */
    public function setErrorView($view)
    {
        self::$error_view = $view;
        return $this;
    }

    public function getErrorView()
    {
        return self::$error_view;
    }

    //错误处理类注册
    static public function complete()
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
                self::$error_type = 'NOTICE';
                break;
            //错误级别：警告
            case E_WARNING:
            case E_USER_WARNING:
            self::$error_type = 'WARNING';
                break;
            default:
                self::$error_type='UNKNOWN ERROR';
                return FALSE;
                break;
        }
        self::$timestamp = date('Y-m-d H:i:s',time());
        self::$file = $filename;
        self::$message = $msg;
        self::$line = $line;
        self::getErrorHandle()->handle(self::instance());
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
                self::$error_type = 'Fatal Error';
                self::$timestamp = date('Y-m-d H:i:s',time());
                self::$file = $error['file'];
                self::$message = $error['message'];
                self::$line = $error['line'];
                self::$class = $trace[0]['class'];
                self::$function = $trace[0]['function'];
                self::$type = $trace[0]['type'];
                self::getErrorHandle()->handle(self::instance());
                break;
        }
    }
    /**
     *自定义异常错误处理函数
     * @param Object Exception $e
     */
    static public function dealException(Exception $e)
    {
        self::$error_type = 'Exception';
        self::$timestamp = date('Y-m-d H:i:s',time());
        self::$message = $e->getMessage();
        self::$trace = $e->getTraceAsString();
        self::$line = $e->getLine();
        self::$file = $e->getFile();
        self::getErrorHandle()->handle(self::instance());
    }

    static private function getErrorHandle()
    {
        static $handle;

        if (!$handle) {
            // 异常处理 handle
            $class = self::$error_handle;

            if ($class && is_string($class) && class_exists($class) &&
                is_subclass_of($class, "\\linkphp\\boot\\exception\\Handle")
            ) {
                $handle = new $class;
            } else {
                $handle = new Handle;

            }
        }

        return $handle;
    }

}
