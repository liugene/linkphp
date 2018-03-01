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
// |               路由解释器
// +----------------------------------------------------------------------

namespace linkphp\boot;

use linkphp\boot\router\Router as RouterPro;
use linkphp\boot\interfaces\RunInterface;

class Router implements RunInterface
{

    private $_instance;

    static private $_router;

    /**
     * 路由解析启动
     * @return Router
     */
    public function init()
    {
        if (!isset($this->_instance)) {
            $this->_instance = new self();
        }

        return $this->_instance;
    }

    static private function router()
    {
        if (!isset(self::$_router)) {
            self::$_router = new RouterPro();
        }

        return self::$_router;
    }

    /**
     * 静态调用Router类方法
     * @param string $method
     * @param array $param
     * @return RouterPro
     */
    static public function __callStatic($method,$param)
    {
        return call_user_func_array([self::router(), $method], $param);
    }

    /**
     * 实例后调用router类方法
     * @param string $name
     * @param array $arguments
     * @return RouterPro
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([self::router(), $name], $arguments);
    }
}