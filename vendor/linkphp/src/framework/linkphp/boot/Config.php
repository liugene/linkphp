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
class Config
{

    private $platform;

    private static $load_path = LOAD_PATH;

    //保存已经加载的配置信息
    static private $config = [];

    static private $instance;

    static public function instance()
    {
        if(is_null(self::$instance)) self::$instance = new self();

        return self::$instance;
    }

    public function setLoadPath($path)
    {
        self::$load_path = $path;
        return $this;
    }

    public function getLoadPath()
    {
        return self::$load_path;
    }

    static public function import($file)
    {
        if(is_array($file)) self::$config = $file;
        return;
    }

    static public function set($name='')
    {
        if(is_object($name)) return self::instance();
        $config = require self::$load_path . 'configure.php';
        self::$config = array_merge(self::$config,$config);
    }

    public function setPlatform($platform)
    {
        $this->platform = $platform;
        return $this;
    }

    /**
     * @param [string] $name 配置名
     * @param [string] $value 配置值
     * @return [string] 返回指定键名的键值
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
        if(array_key_exists($name, self::$config)){
            $value = self::$config[strtolower($name)];
        }
        return $value;
    }

    /**
     * 检测配置是否存在
     * @access public
     * @param  string $name 配置参数名（支持二级配置 . 号分割）
     * @return bool
     */
    static public function has($name)
    {
        if (!strpos($name, '.')) {
            return isset(self::$config[strtolower($name)]);
        }

        // 二维数组设置和获取支持
        $name = explode('.', $name, 2);
        return isset(self::$config[strtolower($name[0])][$name[1]]);
    }
}