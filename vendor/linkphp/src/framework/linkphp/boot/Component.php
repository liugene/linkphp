<?php

namespace linkphp\boot;

use linkphp\boot\di\Container;

class Component
{

    static private $_instance;

    static private $_container;

    /**
     * 容器初始化，并取得容器类实例
     * @return Container
     */
    static private function container()
    {
        if (!isset(self::$_container)) {
            self::$_container = Container::getInstance();
        }

        return self::$_container;
    }

    /**
     * 容器初始化，并取得容器类实例
     * @return Component
     */
    static public function instance()
    {
        if (!isset(self::$_instance)) self::$_instance = new self();

        return self::$_instance;
    }

    /**
     * 静态调用Router类方法
     * @param string $method
     * @param array $param
     * @return Container
     */
    static public function __callStatic($method,$param)
    {
        return call_user_func_array([self::container(), $method], $param);
    }

    /**
     * 实例后调用router类方法
     * @param string $name
     * @param array $arguments
     * @return Container
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([self::container(), $name], $arguments);
    }

}