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
// |               框架启动调度类
// +----------------------------------------------------------------------

namespace linkphp\bootstrap;
use system\core\Engine;

class Console
{
    static public function init()
    {
        //加载额外文件
        static::loadCommonFile();
        //系统引擎机制初始化
        Engine::init();
        //判断运行环境模式
        static::checkEnvMode();
    }

    //加载公共文件
    static public function loadCommonFile()
    {
        static::loadFrameworkFunctionFile();
        static::loadApplicationDirListFile();
    }

    //加载框架函数库文件
    static public function loadFrameworkFunctionFile(){
        //加载LinkPHP框架系统函数
        if(is_file(LINKPHP_PATH . 'functions.php')){
            require(LINKPHP_PATH . 'functions.php');
        }
    }

    //循环加载应用自动加载目录中文件
    static public function loadApplicationDirListFile()
    {
        if(is_dir(ROOT_PATH . 'autoload')){
            $dir = opendir(ROOT_PATH . 'autoload');
            //循环读取目录内的所有文件
            while(($filename = readdir($dir)) !== false){
                $loadfile = $filename;
                //循环判断是否为文件
                if(is_file(ROOT_PATH . 'autoload/' . $loadfile)){
                    //是循环载入
                    require(ROOT_PATH . 'autoload/' . $loadfile);
                }
            }
            closedir($dir);
        }
    }

    //检测运行环境
    static public function checkEnvMode()
    {
        //判断是否为命令行模式
        if(IS_CLI){
            //命令行模式初始化操作
            Command::init();
        } else {
            //路由初始化
            Router::init();
        }
    }

}

