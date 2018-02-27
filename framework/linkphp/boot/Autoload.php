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

    //composer目录
    static private $vendor_path = VENDOR_PATH;

    //类库映射配置文件目录
    static private $load_path = LOAD_PATH;

    //框架目录
    static private $framework_path = FRAMEWORK_PATH;

    //文件后缀名
    static private $ext = EXT;

    static private $_instance;

    //扩展类库目录
    static private $extend_path = EXTEND_PATH;

    static public function register(Autoload $autoload){}

    static public function instance()
    {
        if (!isset(self::$_instance)) self::$_instance = new self();

        return self::$_instance;
    }

    public function setVendorPath($path)
    {
    self::$vendor_path = $path;
    return $this;
    }

    public function setLoadPath($path)
    {
        self::$load_path = $path;
        return$this;
    }

    public function setFrameWorkPath($path)
    {
        self::$framework_path = $path;
        return $this;
    }

    public function setExt($ext)
    {
        self::$ext = $ext;
        return $this;
    }

    public function setExtendPath($path)
    {
        self::$extend_path = $path;
        return $this;
    }

    static public function getVendorPath()
    {
        return self::$vendor_path;
    }

    static public function getLoadPath()
    {
        return self::$load_path;
    }

    static public function getFrameWorkPath()
    {
        return self::$framework_path;
    }

    static public function getExt()
    {
        return self::$ext;
    }

    static public function getExtendPath()
    {
        return self::$extend_path;
    }

    /**
     * 自动加载注册方法
     */
    public function complete()
    {
        self::autoloadFunc();
        if(file_exists(self::$load_path . 'map.php')){
            self::addNamespace(include(self::$load_path . 'map.php'));
        }
        //加载composer等扩展自动加载机制
        self::loadExtendAutoload();
        //psr4自动加载机制排序
        self::sortPsr4ByArrAyFirstKey();
        //psr0自动加载机制排序
        self::sortPsr0ByArrAyFirstKey();
        //指定自动加载机制排序
        //static::sortFileByArrAyFirstKey();
        if(is_array(self::$_autoload_func)){
            foreach(self::$_autoload_func as $k => $v){
                spl_autoload_register(array(__CLASS__, $v));
            }
        } else {
            spl_autoload_register(array(__CLASS__, self::$_autoload_func));
        }
        return $this;
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
            $filename = self::$framework_path . str_replace('\\', '/', $class_name) . self::$ext;
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
        if (file_exists(self::$vendor_path . 'composer/autoload_namespaces.php')) {
            $class_map_psr0 = require self::$vendor_path . 'composer/autoload_namespaces.php';
            self::addExtendClassPsr0($class_map_psr0);
        }

        if (file_exists(self::$vendor_path . 'composer/autoload_psr4.php')) {
            $class_map_psr4 = require self::$vendor_path . 'composer/autoload_psr4.php';
            self::addExtendClassPsr4($class_map_psr4);
        }

        if (file_exists(self::$vendor_path . 'composer/autoload_classmap.php')) {
            $class_map = require self::$vendor_path . 'composer/autoload_classmap.php';
            if ($class_map) {
                self::addExtendClassMap($class_map);
            }
        }

        if (file_exists(self::$vendor_path . 'composer/autoload_files.php')) {
            $includeFiles = require self::$vendor_path . 'composer/autoload_files.php';
            self::addExtendFile($includeFiles);
            foreach (self::$_map['autoload_namespace_file'] as $fileIdentifier => $file) {
                if(file_exists($file)){
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
    static public function addNamespace($namespace,$path='')
    {
        return self::$_map = $namespace;
    }

    /**
     * 加载自动类
     */
    static public function loaderClass($class_name)
    {
        if(!empty(self::$_sort_psr4_map)){
            if(!self::findPsr4($class_name)){
                if(!empty(self::$_sort_psr0_map)){
                    if(!self::findPsr0($class_name)){
                        if(!self::findExtends($class_name)){
                            //不存在
                            //抛出异常
                            throw new Exception("无法加载类" . $class_name);
                        }
                    }
                } else {
                    if(!self::findExtends($class_name)){
                        //不存在
                        //抛出异常
                        throw new Exception("无法加载类" . $class_name);
                    }
                }
            }
        }
    }

    static private function findPsr4($class_name)
    {
        //查找psr4命名空间类
        if(array_key_exists($class_name[0],self::$_sort_psr4_map)){
            foreach(self::$_sort_psr4_map[$class_name[0]] as $prefix){
                if(strpos($class_name,$prefix) === 0){
                    $filename = str_replace('\\','/',str_replace('\\', '/',self::$_map['autoload_namespace_psr4'][$prefix][0]) . strrchr($class_name,'\\') . self::$ext);
                    if(is_file($filename)){
                        __require_file($filename);
                        return true;
                    } else {
                        //尝试补位查找类文件
                        $full_filename = str_replace('\\','/',str_replace('\\', '/',self::$_map['autoload_namespace_psr4'][$prefix][0]) . str_replace($prefix,'\\',$class_name) . self::$ext);
                        if(file_exists($full_filename)){
                            __require_file($full_filename);
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    static private function findPsr0($class_name)
    {
        //查找psr0命名空间
        if(array_key_exists($class_name[0],self::$_sort_psr0_map)){
            foreach(self::$_sort_psr0_map[$class_name[0]] as $prefix){
                if(strpos($class_name,$prefix) === 0){
                    $filename = str_replace('/', '\\',self::$_map['autoload_namespace_psr0'][$prefix][0]) . strrchr($class_name,'\\') . EXT;
                    if(file_exists($filename)){
                        __require_file($filename);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    static private function findExtends($class_name)
    {
        $filename = str_replace('/', '\\',self::$extend_path . $class_name) . EXT;
        if(file_exists($filename)){
            __require_file($filename);
            return true;
        }
        return false;
    }

    /*对psr4命名空间按照首字母升序排序*/
    static private function sortPsr4ByArrAyFirstKey()
    {
        $newPsr4Namespace = [];
        ksort(self::$_map['autoload_namespace_psr4']);
        foreach(self::$_map['autoload_namespace_psr4'] as $key => $value){
            $newPsr4Namespace[$key[0]][] = $key;
        }
        self::$_sort_psr4_map = $newPsr4Namespace;
    }

    /*对psr0命名空间按照首字母升序排序*/
    static private function sortPsr0ByArrAyFirstKey()
    {
        $newPsr0Namespace= [];
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