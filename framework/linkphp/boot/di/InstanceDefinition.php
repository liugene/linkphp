<?php

namespace linkphp\boot\di;

class InstanceDefinition
{

    /**
     * 实例别名
     * string $alias
     */
    private $alias;

    /**
     * 是否单例
     * Bool $is_singleton
     */
    private $is_singleton = false;

    /**
     * 是否立即实例
     * bool $is_eager
     */
    private $is_eager = false;

    /**
     * 设置闭包执行方法
     */
    private $call_back;

    /**
     * 完整类名，通过反射获得实例
     */
    private $class_name;

    private $instance;

    /**
     * 定义一个实例别名
     * @param string $alias
     * @return $this
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * 获得一个实例定义的别名
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * 定义一个实例对象保存
     * @param Object $instance
     * @return $this
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
        return $this;
    }

    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * 定义一个实例对象是否为单例
     * @param bool $bool
     * @return $this
     */
    public function setIsSingleton($bool)
    {
        $this->is_singleton = $bool;
        return $this;
    }

    public function isSingleton()
    {
        return $this->is_singleton;
    }

    /**
     * 定义一个实例对象是否立即初始化
     * @param bool $bool
     * @return $this
     */
    public function setIsEager($bool)
    {
        $this->is_eager = $bool;
        return $this;
    }

    public function isEager()
    {
        return $this->is_eager;
    }

    /**
     * 定义一个实例对象的回调函数
     * @param callable $function
     * @return $this
     */
    public function setCallBack($function)
    {
        $this->call_back = $function;
        return $this;
    }

    public function isCallBack()
    {
        return $this->call_back;
    }

    /**
     * 定义一个实例对象的类名
     * @param string $class_name
     * @return $this
     */
    public function setClassName($class_name)
    {
        $this->class_name = $class_name;
        return $this;
    }

    public function getClassName()
    {
        return $this->class_name;
    }

    public function isInstance()
    {
        return is_null($this->instance);
    }

}
