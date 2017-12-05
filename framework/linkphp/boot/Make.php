<?php

namespace linkphp\boot;
// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liugene <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               LinkPHP框架系统核心目录常见类
// +----------------------------------------------------------------------


class Make{
    static public function dir(){}

    //创建URL
    /**
     * Make::url方法自动生成URL
     * @param $c [string] 需要设置跳转的控制器 默认为空获取当前控制器名
     * @param $a [string] 需要设置跳转的方法名 默认为空获取当前方法名
     * @param $p [string] 需要设置跳转的模块名 默认为空获取当前的模块名
     * @return url [string] 返回拼接好的URL跳转地址
     */
    static public function url($c=null,$a=null,$p=null)
    {
        switch(Configure::get('url_module')){
            case 0:
                $platform = isset($_GET[Configure::get('var_platform')]) ? ucfirst($_GET[Configure::get('var_platform')]) : Configure::get('var_platform');
                $p = is_null($p) ? $platform : $p;
                $c = is_null($c) ? $_GET[Configure::get('var_controller')] : ucfirst($c);
                $a = is_null($a) ? $_GET[Configure::get('var_action')] : ucfirst($a);
                $url = 'index.php?' . Configure::get('var_platform') . '=' . $p . '&' . Configure::get('var_controller') . '=' . $c . '&' . Configure::get('var_action') . '=' . strtolower($a);
                break;
            case 1;
                $url = 'index.php/' . Configure::get('default_platform') . '/' . $c . '/' . strtolower($a);
                break;
        }
        return $url;
    }

}

