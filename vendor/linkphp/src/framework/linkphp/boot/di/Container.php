<?php

namespace linkphp\boot\di;

use linkphp\boot\Exception;

use Closure;
use ReflectionClass;
use ReflectionParameter;
use ReflectionFunction;

class Container
{

    /**
     * 保存所有绑定的实例
     * key 为alias value 为 InstanceDefinition实例对象
     * @Array $_service
     */
    private $definition_map = [];

    static private $_instance;

    /**
     * 获得所有绑定的实例结果
     */
    public function getContainerInstance()
    {
        return $this->definition_map;
    }


    static public function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance = new self();
            return self::$_instance;
        }
        return self::$_instance;
    }

    /**
     * @param InstanceDefinition $definition
     */
    public function bind(InstanceDefinition $definition)
    {
        /**
         * 断言别名是否合法
         */
        $this->assertAliasNameAvailable($definition->getAlias());

        /**
         * 保存至私有属性统一管理
         */
        $this->definition_map[$definition->getAlias()] = $definition;

        /**
         * 初始化需要立即实例化的类
         */
        $this->initEagerDefinition($definition);
    }

    /**
     * 只初始化需要立即实例化的类
     * @param InstanceDefinition $definition
     */
    private function initEagerDefinition(InstanceDefinition $definition)
    {
        /**
         * 如果是立即初始化即立即实例化
         */
        if($definition->isEager()){
            /**
             * 查看是否已经实例化过
             */
            if(!$definition->isInstance()){
                return $definition->getInstance();
            }
            $definition->setInstance($this->get($definition->getAlias()));
        }
    }

    public function __set($alias, InstanceDefinition $definition)
    {
        $definition->setAlias($alias);
        /**
         * 断言别名是否合法
         */
        $this->assertAliasNameAvailable($definition->getAlias());

        /**
         * 保存至私有属性统一管理
         */
        $this->definition_map[$definition->getAlias()] = $definition;

        /**
         * 初始化需要立即实例化的类
         */
        $this->initEagerDefinition($definition);
    }

//    public function get($alias)
//    {
//        $definition = $this->definition_map[$alias];
//        if($definition->isInstance()){
//            return $this->getByAlias($alias);
//        }
//        return $definition->getInstance();
//    }

    /**
     * @param string $alias
     * @throws
     * @return Object $instance
     */
    public function get($alias)
    {
        /**
         * 判断别名是否为ReflectionParameter实例对象
         *
         */
        if($alias instanceof ReflectionParameter){
            /**
             * true
             * 执行循环依赖注入所需要的类
             */
            $this->bind((new InstanceDefinition())
                ->setAlias($alias->getName())
                ->setIsEager(true)
                ->setClassName($alias->getClass()->getName())
                ->setIsSingleton(true)
            );
            $instance = $this->build($alias->getName());
        } else {
            /**
             * false
             * 执行普通的实例化类
             */
            $instance = $this->build($alias);
        }
        return $instance;
    }

    /**
     * 魔术方法
     */
    public function __get($alias)
    {
        /**
         * 判断别名是否为ReflectionParameter实例对象
         *
         */
        if($alias instanceof ReflectionParameter){
            /**
             * true
             * 执行循环依赖注入所需要的类
             */
            $this->bind((new InstanceDefinition())
                ->setAlias($alias->getName())
                ->setIsEager(true)
                ->setClassName($alias->getClass()->getName())
                ->setIsSingleton(true)
            );
            $instance = $this->build($alias->getName());
        } else {
            /**
             * false
             * 执行普通的实例化类
             */
            $instance = $this->build($alias);
        }
        return $instance;
    }

    /**
     * 统一的类实例化入口
     */
    private function build($alias)
    {
        /**
         * 判断是否存在
         * 不存在执行立即自动注入功能并返回实例对象
         */
        if(!isset($this->definition_map[$alias])){
            $this->assertClassNameAvailable($alias);
            $this->bind(
                (new InstanceDefinition())
                    ->setAlias($alias)
                    ->setIsEager(true)
                    ->setClassName($alias)
                    ->setIsSingleton(true)
            );
            return $this->build($alias);
        }
        /**
         * 通过别名获得实例定义的信息
         * 返回实例对象
         */
        $definition = $this->definition_map[$alias];
        /**
         * 判断是否为回调方法注入
         */
        if($definition->isCallBack() instanceof Closure){
            /**
             * true
             * 执行回调方法注入
             */
            $instance = $this->callableBuilder($definition);
            /**
             * 判断是否为单例
             */
            if($definition->isSingleton()){
                /**
                 * true
                 * 将实例对象保存
                 */
                $definition->setInstance($instance);
            }
            return $instance;
        }

        /**
         * false
         * 不是回调方法注入，则为类名注入
         * 执行类名注入方法
         */
        if($definition->isInstance()){
            /**
             * 断言类名是否合法
             */
            $this->assertClassNameAvailable($definition->getClassName());
            $instance = $this->builder($definition);
            if($definition->isSingleton()){
                $definition->setInstance($instance);
            }
            return $instance;
        }
        return $definition->getInstance();
    }

    /**
     * 类名注入方法
     * @param InstanceDefinition $definition
     * @throws
     * @return Object
     */
    private function builder(InstanceDefinition $definition)
    {
        /**
         * 通过反射获取类的信息
         */
        $reflectorClass = new ReflectionClass($definition->getClassName());
        /**
         * 获取类的构造方法
         */
        $reflectorFunc = $reflectorClass->getConstructor();
        /**
         * 判断类是否有构造方法
         */
        if(empty($reflectorFunc)){
            /**
             * false
             * 返回类的实例
             */
            return $reflectorClass->newInstance();
        }
        /**
         * true
         * 判断类是否public
         */
        if(!$reflectorFunc->isPublic()){
            /**
             * false
             * 抛出异常
             */
            throw new ContainerException('类的构造方法不可见!');
        }
        /**
         * 获取构造方法的参数
         */
        $reflectorParam = $reflectorFunc->getParameters();
        /**
         * 判断类构造方法是否有参数
         */
        if(empty($reflectorParam)){
            /**
             * false
             * 返回类的实例
             */
            return $reflectorClass->newInstance();
        }
        /**
         * 遍历构造方法的参数进行注入
         */
        foreach($reflectorParam as $parameter){
            $dependentClass = $parameter->getClass();
            if(!is_null($dependentClass)){
                /**
                 * 执行get方法取得实例
                 * 并注入
                 */
                $realName[] = $this->get($parameter);
                /**
                 * 依赖注入相关实例并返回
                 */
                return $reflectorClass->newInstanceArgs($realName);
            }
        }
    }

    /**
     * 闭包注入方法
     * @param InstanceDefinition $definition
     * @throws
     * @return Object
     */
    private function callableBuilder(InstanceDefinition $definition)
    {
        /**
         * 获得闭包函数
         */
        $instance = $definition->isCallBack();
        /**
         * 通过方法反射获得对应实例类
         */
        $reflectorFunc =  new ReflectionFunction($instance);
        /**
         * 获得实例后的参数
         */
        $reflectorParam = $reflectorFunc->getParameters();
        /**
         * 判断是否有参数
         *
         */
        if(empty($reflectorParam)){
            /**
             * false
             * 直接执行闭包函数并返回实例
             */
            return $instance($this);
        } else {
            /**
             * true
             * 循环遍历参数
             */
            foreach($reflectorParam as $parameter){
                /**
                 * 获取类名
                 */
                $dependentClass = $parameter->getClass();
                if(!is_null($dependentClass)){
                    /**
                     * 执行get方法取得实例
                     * 并注入
                     */
                    $realName[] = $this->get($parameter);
                    return $reflectorFunc->invokeArgs($realName);
                }
            }
        }
    }

    /**
     * 断言别名是否合法
     * @throws
     * @throws
     * @param string $alias
     */
    private function assertAliasNameAvailable($alias)
    {
        if(!is_string($alias) || empty($alias)){
            /**
             * 不合法抛出 异常
             */
            throw new Exception('别名不合法!');
        }
        if(isset($this->definition_map[$alias])){
            /**
             * 不合法抛出 异常
             */
            throw new Exception($alias . '别名已经设置');
        }
    }

    /**
     * 断言类名是否合法
     * @throws
     * @param string $class_name
     */
    private function assertClassNameAvailable($class_name)
    {
        if(!is_string($class_name) || empty($class_name)){
            /**
             * 不合法抛出 异常
             */
            throw new Exception('类名未设置!');
        }
    }

}
