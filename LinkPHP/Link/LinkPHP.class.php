<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                 LinkPHP框架初始化类               *
 * --------------------------------------------------*
 */

namespace Link;
class Link
{
    /**
     * 入口
     */
     static public function start()
     {
        
        //运行自定义错误处理方式
        static::_initErrorHandler();
        //注册自动加载方法
        static::_initAutoload();
        //加载LinkPHP框架系统、应用公共函数
        static::_initLinkFunc();
        //路由参数初始化
        static::_initRouter();
        //声明当前平平路径
        static::_initPlatformPathConst();
        //分发请求
        static::_dispatch();

     }
     
     /**
      * 自定义错误信息触发器
      */
     static private function _initErrorHandler()
     {
        require CORE_PATH . 'ErrorHandler' . EXT;
        set_error_handler(array('ErrorHandler','linkErrorFunc'));
     }

    /**
     * 注册命名空间第三方类库加载方法
     * 注册控制器模型类自动加载
     */
    static public function _initAutoload()
    {
        require CORE_PATH . 'Autoload' . EXT;
        spl_autoload_register(array('Autoload', 'namespaceAutoload'));
        spl_autoload_register(array('Autoload','userAutoload'));
    }

    /**
     * 加载LinkPHP框架系统函数库
     */
    static private function _initLinkFunc()
    {
        //加载LinkPHP框架系统函数
        require LINKPHP_PATH . 'Function/' . 'functions.php';
        //加载LinkPHP框架应用函数库
        require APPLICATION_PATH . 'Common/Function/functions.php';
    }

    /**
     * 路由类支持多模式
     */
    static private function _initRouter()
    {
        new Router();
    }

    /**
     * 声明当前平台路径常量
     */
    static private function _initPlatformPathConst()
    {
        define('CURRENT_CONTROLLER_PATH',APPLICATION_PATH . PLATFORM . '/Controller/');
        define('CURRENT_MODEL_PATH', APPLICATION_PATH . PLATFORM . '/Model/');
        define('CURRENT_VIEW_PATH', APPLICATION_PATH . PLATFORM . '/View/');

    }

    /**
     * 分发请求
     */
    static private function _dispatch()
    {
        new Dispatch();
    }

}

?>