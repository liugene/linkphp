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
// |               LinkPHP框架自动化加载类
// +----------------------------------------------------------------------

namespace linkphp\boot;
class Autoload
{

    /**
     * 命名空间集合
     */
    static private $_map = [];

    /*排序后psr4命名空间*/
    static private $_sort_psr4_map = [];

    /*排序后psr0命名空间*/
    static private $_sort_psr0_map = [];

    /*自动加载方法*/
    static private $_autoload_func;

    /**
     * 自动加载注册方法
     */
    static public function register()
    {
        self::autoloadFunc();
        if(is_file(LOAD_PATH . 'map.php')){
            self::addNamespace(include(LOAD_PATH . 'map.php'));
        }
        if(is_array(self::$_autoload_func)){
            foreach(self::$_autoload_func as $k => $v){
                spl_autoload_register(array(__CLASS__, $v));
            }
        } else {
            spl_autoload_register(array(__CLASS__, self::$_autoload_func));
        }
        //加载composer等扩展自动加载机制
        self::loadExtendAutoload();
        //psr4自动加载机制排序
        self::sortPsr4ByArrAyFirstKey();
        //psr0自动加载机制排序
        self::sortPsr0ByArrAyFirstKey();
        //指定自动加载机制排序
        //static::sortFileByArrAyFirstKey();
    }

    /*自动加载方法*/
    static private function autoloadFunc()
    {
        self::$_autoload_func = ['classMapAutoload','namespaceAutoload','loaderClass'];
    }

    /**
     * 映射类自动加载方法
     * */
    static public function classMapAutoload($class_name)
    {
        /**
         * 映射类自动加载方法
         * 类名与类文件映射数组
         */
        $class_map = self::$_map;
        $linkphp_class_list = $class_map['class_autoload_map'];
        //判断是否为核心工具类
        if(isset($linkphp_class_list[$class_name])){
            //是核心工具类
            __require_file($linkphp_class_list[$class_name]);
        }
    }
    /**
     * 命名空间第三方类库自动加载方法
     * param string $class_name  实例化的类名
     */
    static public function namespaceAutoload($class_name)
    {
        $name = strstr($class_name, '\\', true);

        if($name == 'util'){
            $filename = FRAMEWORK_PATH . str_replace('\\', '/', $class_name) . EXT;
            /**
             * 判断文件是否存在
             */
            if(file_exists($filename)){
                //存在引入
                //Link系统目录下面的命名空间自动定位
                __require_file($filename);
            } else {
                //不存在
                //抛出异常
                throw new Exception("无法加载工具类");
            }
        }
    }
    /**
     * 控制器模型类自动加载方法
     */

    /*
     * composer自动加载
     * */
    static public function loadExtendAutoload()
    {

        /**
         * 加载Composer自动加载
         */
        if (is_file(VENDOR_PATH . 'composer/autoload_namespaces.php')) {
            $class_map_psr0 = require VENDOR_PATH . 'composer/autoload_namespaces.php';
            self::addExtendClassPsr0($class_map_psr0);
        }

        if (is_file(VENDOR_PATH . 'composer/autoload_psr4.php')) {
            $class_map_psr4 = require VENDOR_PATH . 'composer/autoload_psr4.php';
            self::addExtendClassPsr4($class_map_psr4);
        }

        if (is_file(VENDOR_PATH . 'composer/autoload_classmap.php')) {
            $class_map = require VENDOR_PATH . 'composer/autoload_classmap.php';
            if ($class_map) {
                self::addExtendClassMap($class_map);
            }
        }

        if (is_file(VENDOR_PATH . 'composer/autoload_files.php')) {
            $includeFiles = require VENDOR_PATH . 'composer/autoload_files.php';
            self::addExtendFile($includeFiles);
            foreach (static::$_map['autoload_namespace_file'] as $fileIdentifier => $file) {
                if(is_file($file)){
                    __include_file($file);
                }
            }
        }
    }

    /*追加扩展Psr0标准类库自动加载*/
    static private function addExtendClassPsr0($namespace){
        self::$_map['autoload_namespace_psr0'] = array_merge(self::$_map['autoload_namespace_psr0'],$namespace);
    }

    /*追加扩展Psr4标准类库自动加载*/
    static private function addExtendClassPsr4($namespace){
        self::$_map['autoload_namespace_psr4'] = array_merge(self::$_map['autoload_namespace_psr4'],$namespace);
    }

    /*追加扩展标准类库自动映射自动加载*/
    static private function addExtendClassMap($class_map){
        self::$_map['class_autoload_map'] = array_merge(self::$_map['class_autoload_map'],$class_map);
    }

    /*追加扩展标准类库自动映射自动加载*/
    static private function addExtendFile($includeFiles){
        self::$_map['autoload_namespace_file'] = array_merge(self::$_map['autoload_namespace_file'],$includeFiles);
    }

    /**
     * 注册命名空间名
     */
    static public function addNamespace($namespace)
    {
        return self::$_map = $namespace;
    }

    /**
     * 加载自动类
     */
    static public function loaderClass($class_name)
    {
        //查找psr4命名空间类
        if(array_key_exists($class_name[0],self::$_sort_psr4_map)){
            foreach(self::$_sort_psr4_map[$class_name[0]] as $prefix){
                if(strpos($class_name,$prefix) === 0){
                    $filename = str_replace('\\','/',str_replace('\\', '/',self::$_map['autoload_namespace_psr4'][$prefix][0]) . strrchr($class_name,'\\') . EXT);
                    if(is_file($filename)){
                        __require_file($filename);
                    } else {
                        //尝试补位查找类文件
                        $fullfilename = str_replace('\\','/',str_replace('\\', '/',self::$_map['autoload_namespace_psr4'][$prefix][0]) . str_replace($prefix,'\\',$class_name) . EXT);
                        if(is_file($fullfilename)){
                            __require_file($fullfilename);
                        }
                    }
                }
            }
        }

        //查找psr0命名空间
        if(array_key_exists($class_name[0],self::$_sort_psr0_map)){
            foreach(self::$_sort_psr0_map[$class_name[0]] as $prefix){
                if(strpos($class_name,$prefix) === 0){
                    $filename = str_replace('/', '\\',self::$_map['autoload_namespace_psr4'][$prefix][0]) . strrchr($class_name,'\\') . EXT;
                    if(is_file($filename)){
                        __require_file($filename);
                    }
                }
            }
        }
    }

    /**
     * 查找文件
     */
    static public function findFile()
    {
    }

    /*对psr4命名空间按照首字母升序排序*/
    static private function sortPsr4ByArrAyFirstKey()
    {
        ksort(self::$_map['autoload_namespace_psr4']);
        foreach(self::$_map['autoload_namespace_psr4'] as $key => $value){
            $newPsr4Namespace[$key[0]][] = $key;
        }
        self::$_sort_psr4_map = $newPsr4Namespace;
    }

    /*对psr0命名空间按照首字母升序排序*/
    static private function sortPsr0ByArrAyFirstKey()
    {
        ksort(self::$_map['autoload_namespace_psr0']);
        foreach(self::$_map['autoload_namespace_psr0'] as $key => $value){
            $newPsr0Namespace[$key[0]][] = $key;
        }
        self::$_sort_psr0_map = $newPsr0Namespace;
    }

}

function __require_file($filename)
{
    return require($filename);
}

function __include_file($filename)
{
    return include($filename);
}