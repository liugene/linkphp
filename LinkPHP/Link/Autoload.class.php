<?php
/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *               LinkPHP框架自动化加载类             *
 * --------------------------------------------------*
 */
class Autoload
{
    /**
     * 系统自动加载方法
    */
    static public function LinkSystemAutoload($class_name)
    {
        $name = strstr($class_name, '\\', true);
        if($name == 'System'){
            $filename = LINKPHP_PATH . str_replace('\\', '/', $class_name) . '.System.php';
            //判断文件是否存在
            if(file_exists($filename)){
                //存在引入
                //Link系统目录下面的命名空间自动定位
                require $filename;
            } else {
                //不存在
                //抛出异常
                throw new \Exception("无法加载系统类");
            }
        }
    }

    /**
     * 核心工具类自动加载方法
     * */
    static public function toolClassAutoload($class_name)
    {
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
    }
    /**
     * 命名空间第三方类库自动加载方法
     * @param string $class_name  实例化的类名
     */
    static public function namespaceAutoload($class_name)
    {
        $name = strstr($class_name, '\\', true);
        if($name == 'Link'){
            $filename = LINKPHP_PATH . str_replace('\\', '/', $class_name) . EXT;
            //判断文件是否存在
            if(file_exists($filename)){
                //存在引入
                //Link核心控制器link目录下面的命名空间自动定位
                require LINKPHP_PATH . str_replace('\\', '/', $class_name) . EXT;
            } else {
                //不存在
                //抛出异常
                throw new \Exception("无法加载框架核心类");
            }
        }
        elseif($name == 'Helper'){
            $filename = LINKPHP_PATH . str_replace('\\', '/', $class_name) . EXT;
            //判断文件是否存在
            if(file_exists($filename)){
                //存在引入
                //系统扩展工具类LinkPHP目录下面的命名空间自动定位
                require LINKPHP_PATH . str_replace('\\', '/', $class_name) . EXT;
            } else {
                //不存在
                //抛出异常
                throw new \Exception("无法加载框架系统核心扩展类");
            }
        }
        elseif(in_array($name, array('Org', 'Com', 'Vender'))){
            $filename = EXTEND_PATH . 'Library/' . str_replace('\\', '/', $class_name) . EXT;
            //判断文件是否存在
            if(file_exists($filename)){
                //存在引入
                //第三方扩展类库Extend/Library 目录下面的命名空间自动定位
                require EXTEND_PATH . 'Library/' . str_replace('\\', '/', $class_name) . EXT;
            } else {
                //不存在
                //抛出异常
                throw new \Exception("无法加载框架第三方扩展类");
            }
        }
        elseif(in_array($name, array('Controller', 'Model'))){
            $filename = EXTEND_PATH . str_replace('\\', '/', $class_name) . EXT;
            //判断文件是否存在
            if(file_exists($filename)){
                //存在引入
                //扩展控制器模型类LinkPHP 目录下面的命名空间自动定位
                require EXTEND_PATH . str_replace('\\', '/', $class_name) . EXT;
            } else {
                //不存在
                //抛出异常
                throw new \Exception("无法加载框架第三方扩展控制器模型类");
            }
        }
        elseif($name == 'Common'){
            //站点公共控制器模型类
            if(substr($class_name, -10) == 'Controller'){
                $filename = APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
                //判断文件是否存在
                if(file_exists($filename)){
                    //存在引入
                    //判断是否为公共控制器类
                    //控制器类截取后10个匹配Controller
                    require APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
                } else {
                    //不存在
                    //抛出异常
                    throw new \Exception("无法加载框架站点公共控制器类");
                }
            }
            elseif(substr($class_name, -5) == 'Model'){
                $filename = APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
                //判断文件是否存在
                if(file_exists($filename)){
                    //存在引入
                    //判断是否为公共模型类
                    //控制器类截取后5个匹配Model
                    require APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
                } else {
                    //不存在
                    //抛出异常
                    throw new \Exception("无法加载框架站点公共模型类");
                }
            }
            elseif(substr($class_name,-5) == 'SQLVI'){
                $filename = APPLICATION_PATH . str_replace('\\', '/', $class_name) . '.SQLVI.php';
                //判断文件是否存在
                if(file_exists($filename)){
                    //存在引入
                    require APPLICATION_PATH . str_replace('\\', '/', $class_name) . '.SQLVI.php';
                } else {
                    //不存在
                    //抛出异常
                    throw new \Exception("无法加载框架站点公共数据库视图索引类");
                }
            }
        }
    }
    /**
     * 控制器模型类自动加载方法
     */
    static public function userAutoload($class_name)
    {
        //判断是否为可增加(控制器类，模型类)
        //控制器类截取后10个匹配Controller
        if(substr($class_name,-10) == 'Controller'){
            //$filename = str_replace('\\', '/', $class_name);
            $filename = APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
            //判断文件是否存在
            if(file_exists($filename)){
                //存在引入
                require APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
            } else {
                //不存在
                //抛出异常
                throw new \Exception("无法加载控制器类");
            }
        }
        elseif(substr($class_name,-5) == 'Model'){
            //$filename = str_replace('\\', '/', $class_name);
            $filename = APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
            //判断文件是否存在
            if(file_exists($filename)){
                //存在引入
                require APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
            } else {
                //不存在
                //抛出异常
                throw new \Exception("无法加载模型类");
            }
        }
    }
}
?>