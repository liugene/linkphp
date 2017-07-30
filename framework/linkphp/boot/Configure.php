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
// |               配置类
// +----------------------------------------------------------------------

namespace linkphp\boot;
class Configure
{

    /**
     * 封装C方法用于动态获取以及配置文件
     * @param [string] $name 配置名
     * @param [string] $value 配置值
     * return [string] 返回指定键名的键值
     * 未传入$value时默认null，进行获取项目配置
     * 传入$value时此时为动态配置
     * array_merge() 将2个以及多个数组合并成一个数组，重复的键名在后传入的键值
     * 覆盖最先传入的键值
     * 大C方法加载顺序 当扩展配置开启时首先加载应用模块扩展配置默认扩展配置关闭不进行加载
     * 分组扩展配置的值不会被之后加载进来的配置值覆盖，当应用模块中的键名不存在
     * 然后加载LinkPHP框架系统配置 -> 网站公共配置
     */
    static public function get($name, $value = null)
    {
        if(self::check('extend_model_config', 'true') == 'true'){
            $platform = isset($_GET[self::check('var_platform','true')]) ? ucfirst($_GET[self::check('var_platform','true')]) : self::check('default_platform','true');
            $extend_config['extend'] = require APPLICATION_PATH . 'configure' . $platform . '/configure.php';
            if(array_key_exists($name, $extend_config['extend'])){
                return $extend_config['extend'][strtoupper($name)];
            }
            elseif(!array_key_exists($name,$extend_config['extend'])){
                $config['link'] = require BOOT_PATH . 'configure.php';
                $config['common'] = require LOAD_PATH . 'configure.php';
                $config['conf'] = array_merge($config['link'], $config['common']);
                return $config['conf'][strtoupper($name)];
            }
        } else {
            if($value == null){
                $config['link'] = require BOOT_PATH . 'configure.php';
                $config['common'] = require LOAD_PATH . 'configure.php';
                $config['conf'] = array_merge($config['link'], $config['common']);
                return $config['conf'][strtolower($name)];
            } else {

            }
        }
    }

    /**
     * 应用模块检测扩展配置方法
     * @param [string] $name 需要检测配置名称
     * @value [boolean] 默认为flase ck方法为检测是否存在配置项如果为TRUE则返回配置项的值CK方法获取不到
     * 应用扩展配置项，只能获取项目以及框架公共配置项，如果开启扩展配置项请使用C方法获取
     * @return [bool] 返回检测
     */
    static function check($name,$value='false'){
        if($value == 'true'){
            $config['link'] = require BOOT_PATH . 'configure.php';
            $config['common'] = require LOAD_PATH . 'configure.php';
            $config['conf'] = array_merge($config['link'], $config['common']);
            return $config['conf'][strtolower($name)];
        } else {
            $config['link'] = require BOOT_PATH . 'configure.php';
            $config['common'] = require LOAD_PATH . 'configure.php';
            $config['conf'] = array_merge($config['link'], $config['common']);
            if(in_array(strtoupper($name), $config['conf'])){
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
}