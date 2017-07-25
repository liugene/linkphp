<?php

// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Latham <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               路由
// +----------------------------------------------------------------------

namespace linkphp\boot\router;
class Init
{
    /**
     * url模式
     */
    static private $_url_module;
    /**
     * 请求参数
     */
    static private $_url = array();
    /**
     * 默认操作平台
     */
    static private $_default_platform;
    /**
     * 默认控制器
     */
    static private $_default_controller;
    /**
     * 默认操作方法
     */
    static private $_default_action;


    /**
     * 路由类启动方法
     */
    static public function init($config)
    {
        static::$_url_module = $config['url_module'];
        static::$_default_platform = $config['default_platform'];
        static::$_default_controller = $config['default_controller'];
        static::$_default_action = $config['default_action'];
        $pathinfo = '';
        /**
         * 检测URL模式以及是否开启自定义路由配置
         */
        if(!static::$_url_module == '0' && $config['route_rules_on']){
            $pathinfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
            if(array_key_exists($pathinfo,$config['route_rules'])){
                $pathinfo = $config['route_rules'][$pathinfo];
            }
        }
        /**
         * URL参数匹配
         */
        static::initUrlParam($pathinfo,$config);
    }

    /**
     * URL参数匹配
     */
    static private function initUrlParam($url,$conf)
    {
        $param = array(
            'platform'   => '',
            'controller' => '',
            'action'     => ''
        );
        $url=preg_replace('/\.html$/','',$url);
        switch(static::$_url_module){
            case 0:
                static::initDispatchParamByNomal($conf);
                break;
            case 1:
                $dispatch = explode('/',trim($url,'/'));
                if(in_array('index.php',$dispatch)){
                    $param['platform'] = isset($dispatch['1']) ? $dispatch['1'] : '';
                    $param['controller'] = isset($dispatch['2']) ? $dispatch['2'] : '';
                    $param['action'] = isset($dispatch['3']) ? $dispatch['3'] : '';
                    static::initDispatchParamByPathInfo($param);
                    static::getValue($url,4);
                } else {
                    $param['platform'] = isset($dispatch['0']) ? $dispatch['0'] : '';
                    $param['controller'] = isset($dispatch['1']) ? $dispatch['1'] : '';
                    $param['action'] = isset($dispatch['2']) ? $dispatch['2'] : '';
                    static::initDispatchParamByPathInfo($param);
                    static::getValue($url,3);
                }
                static::$_url = $param;
                break;
            case 2:
                static::initDispatchParamByNomal($conf);
                break;
        }
    }

    /**
     * 循环取出pathinfo模式下GET传值
     */
    static private function getValue($url,$start)
    {
        $get = explode('/',trim($url,'/'));
        if(count($get)>3){
            $param = array_slice($get,$start);
            for($i=0;$i<count($param);$i+=2){
                $_GET[$param[$i]] = $param[$i+1];
            }
            return $_GET;
        }
    }

    /**
     * 默认模式下初拼接分发参数
     */
    static private function initDispatchParamByNomal($config){
        //定义常量保存操作平台
        define('PLATFORM',isset($_GET[$config['var_platform']]) ? strtolower($_GET[$config['var_platform']]) : static::$_default_platform);
        //定义常量保存控制器
        define('CONTROLLER',isset($_GET[$config['var_controller']]) ? strtolower($_GET[$config['var_controller']]) : static::$_default_controller);
        //定义常量保存操作方法
        define('ACTION',isset($_GET[$config['var_action']]) ? strtolower($_GET[$config['var_action']]) : static::$_default_action);
    }

    /**
     * pathinfo 模式下拼接分发参数
     */
    static private function initDispatchParamByPathInfo($param){
        //dump(isset($param['action']));die;
        //定义常量保存操作平台
        define('PLATFORM',isset($param['platform'])&&$param['platform']!='' ? strtolower($param['platform']) : static::$_default_platform);
        //定义常量保存控制器
        define('CONTROLLER',isset($param['controller'])&&$param['controller']!='' ? strtolower($param['controller']) : static::$_default_controller);
        //定义常量保存操作方法
        define('ACTION',isset($param['action'])&&$param['action']!='' ? strtolower($param['action']) : static::$_default_action);
    }

}



?>