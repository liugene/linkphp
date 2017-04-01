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

class Link{
    /**
     * 入口
     */
     static public function start(){
        
        //运行自定义错误处理方式
        static::_initErrorHandler();
        //加载LinkPHP框架系统、应用公共函数
        static::_initLinkFunc();
        //路由参数初始化
        static::_initRouter();
        //声明当前平平路径
        static::_initPlatformPathConst();
        //注册命名空间第三方类库加载方法
        static::_initNamespacAutoload();
        //注册控制器模型类自动加载
        static::_initAutoload();
        //分发请求
        static::_dispatch();

     }
     
     /**
      * 自定义错误信息触发器
      */
     static private function _initErrorHandler(){
        require CORE_PATH . 'ErrorHandler' . EXT;
        set_error_handler(array('ErrorHandler','linkErrorFunc'));
     }

    /**
     * 加载LinkPHP框架系统函数库
     */
     static private function _initLinkFunc(){
        //加载LinkPHP框架系统函数
        require LINKPHP_PATH . 'Function/' . 'functions.php';
        //加载LinkPHP框架应用函数库
        require APPLICATION_PATH . 'Common/Function/functions.php';
     }

    /**
     * 路由模式生成URL
     */
    static private function _initRouter()
    {
        require 'Router' . EXT;
        new Router();
    }

    /**
     * 声明当前平台路径常量
     */
    static private function _initPlatformPathConst(){
        define('CURRENT_CONTROLLER_PATH',APPLICATION_PATH . PLATFORM . '/Controller/');
        define('CURRENT_MODEL_PATH', APPLICATION_PATH . PLATFORM . '/Model/');
        define('CURRENT_VIEW_PATH', APPLICATION_PATH . PLATFORM . '/View/');

    }

    /**
    * 命名空间第三方类库自动加载方法
    * @param string $class_name  实例化的类名
    */ 
    static private function namespaceAutoload($class_name){
        $name = strstr($class_name, '\\', true);
        if($name == 'Link'){
            //Link核心控制器link目录下面的命名空间自动定位
            require LINKPHP_PATH . str_replace('\\', '/', $class_name) . EXT;
            
        }
        elseif($name == 'Sys'){
            //系统扩展工具类LinkPHP目录下面的命名空间自动定位
            require LINKPHP_PATH . str_replace('\\', '/', $class_name) . EXT;
        }
        elseif(in_array($name, array('Org', 'Com', 'Vender'))){
            //第三方扩展类库Extend/Library 目录下面的命名空间自动定位
            require EXTEND_PATH . 'Library/' . str_replace('\\', '/', $class_name) . EXT;
          
        }
        elseif(in_array($name, array('Controller', 'Model'))){
            //扩展控制器模型类LinkPHP 目录下面的命名空间自动定位
            require EXTEND_PATH . str_replace('\\', '/', $class_name) . EXT;
            
        }
        elseif($name == 'Common'){
            //站点公共控制器模型类
            if(substr($class_name, -10) == 'Controller'){
                //判断是否为公共控制器类
                //控制器类截取后10个匹配Controller
                require APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
            }
            elseif(substr($class_name, -5) == 'Model'){
                //判断是否为公共模型类
                //控制器类截取后5个匹配Model
                require APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
            }
        } 
    }
    
  /**
   * 注册命名空间第三方类库加载方法
   */
    static public function _initNamespacAutoload(){
        spl_autoload_register(array(__CLASS__, 'namespaceAutoload'));
    }
     
    /**
     * 控制器模型类自动加载方法
     */
     static public function userAutoload($class_name){
    //先处理确定的（框架内的核心工具类）
    //类名与类文件映射数组
    $LinkPHP_class_list = array(
      //'类名' => '类文件地址'
      'MysqlDB'           => CORE_PATH . 'Tools/' . 'MysqlDB' . EXT,
      'Page'              => CORE_PATH . 'Tools/' . 'Page' . EXT,
      'Image'             => CORE_PATH . 'Tools/' . 'Image' . EXT,
      'Verify'            => CORE_PATH . 'Tools/' . 'Verify' . EXT,
      'Session'           => CORE_PATH . 'Tools/' . 'Session' . EXT,
      'Curl'              => CORE_PATH . 'Tools/' . 'Curl' .EXT,
      'WeiXin'            => CORE_PATH . 'Tools/' . 'WeiXin' . EXT,
      'Upload'            => CORE_PATH . 'Tools/' . 'Upload' . EXT,
      'SendMail'          => CORE_PATH . 'Tools/' . 'SendMail' . EXT,
    );
    
    //判断是否为核心工具类
    if(isset($LinkPHP_class_list[$class_name])){
        //是核心工具类
        require $LinkPHP_class_list[$class_name];
    }
    //判断是否为可增加(控制器类，模型类)
    //控制器类截取后10个匹配Controller
    elseif(substr($class_name,-10) == 'Controller'){
        $filename = str_replace('\\', '/', $class_name);
        require APPLICATION_PATH . $filename . EXT;
        
    }
    elseif(substr($class_name,-5) == 'Model'){
        $filename = str_replace('\\', '/', $class_name);
        require APPLICATION_PATH . $filename . EXT;
    }
 }
   /**
     * 注册控制器模型类自动加载 
     */
    static private function _initAutoload(){
        spl_autoload_register(array(__CLASS__,'userAutoload'));
    }

    /**
     * 分发请求
     */
    static private function _dispatch(){
        //实例化控制器类
        $controller_name = PLATFORM . '\\' . 'Controller' . '\\' . CONTROLLER . 'Controller';
        //实例化
        
        $controller = new $controller_name();
        //调用方法
        $action_name = ACTION;
        $controller -> $action_name();
     }

}

?>