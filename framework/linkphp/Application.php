<?php

namespace linkphp;

use linkphp\boot\Config;
use linkphp\boot\Environment;
use linkphp\boot\Component;
use linkphp\boot\Definition;
use linkphp\boot\di\InstanceDefinition;
use linkphp\boot\Autoload;
use Container;
use linkphp\boot\http\HttpRequest;
use linkphp\boot\Make;

class Application
{
    private $data;

    //保存是否已经初始化
    private static $_init;
    //links启动
    static public function run()
    {
        if(!isset(self::$_init)){
            self::bind(self::definition()
                ->setAlias('env')
                ->setIsSingleton(true)
                ->setClassName('linkphp\\boot\\Environment')
            );
            (new Container())->setup();
            self::get('middle')
                ->import(include LOAD_PATH . 'middleware.php')
                ->beginMiddleware();
            //初次初始化执行
            self::$_init = new self();
        }
        return self::$_init;
    }

    public function check(Environment $env)
    {
        return $this;
    }

    public function request()
    {
        self::get('request')
            ->request()
            ->start();
        return $this;
    }

    public function response()
    {
        Application::hook('destructMiddleware');
        self::get('request')
            ->request()
            ->setData($this->data)
            ->send();
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    static public function getRequestMethod()
    {
        return self::get('request')
            ->request()
            ->getRequestMethod();
    }

    /**
     * 获取环境实例
     * @return \linkphp\boot\router\Router Object
     */
    static public function router()
    {
        return self::get('run');
    }

    /**
     * 获取环境实例
     * @return Environment Object
     */
    static public function env()
    {
        return self::get('env');
    }

    /**
     * 获取HttpRequest类实例
     * @return HttpRequest Object
     */
    static public function httpRequest()
    {
        return self::get('request')->request();
    }

    /**
     * 获取实例
     * @param string $alias
     * @return Object
     */
    static public function get($alias)
    {
        return Component::instance()->get($alias);
    }

    static public function bind(InstanceDefinition $definition)
    {
        return Component::instance()->bind($definition);
    }

    /**
     * 获取实例
     * @return Definition
     */
    static public function definition()
    {
        return (new Definition());
    }

    static public function getContainerInstance()
    {
        return Component::instance()->getContainerInstance();
    }

    static public function input($param='',$filter='')
    {
        return self::httpRequest()->input($param,$filter);
    }

    static public function getInput($filter='')
    {
        return self::httpRequest()->getInput($filter);
    }

    static public function url($c=null,$a=null,$p=null)
    {
        return self::make()->url($c,$a,$p);
    }

    /**
     * 获取MAKE类实例
     * @return Make
     */
    static public function make()
    {
        return self::get('make');
    }

    /**
     * 获取配置信息
     * @param string $key
     * @return Config
     */
    static public function config($key='')
    {
        return $key=='' ? self::get('config') : self::get('config')->get($key);
    }

    static public function middleware($middle,$middleware=null)
    {
        if(self::get('middle')->isValidate($middle)){
            return self::get('middle')->$middle($middleware);
        }
    }

    static public function hook($middle)
    {
        if(self::get('middle')->isValidate($middle)){
            return self::get('middle')->$middle();
        }
    }

    /**
     * 获取装载类实例
     * @return Autoload Object
     */
    static public function autoload()
    {
        return Autoload::instance();
    }

    static public function loader($method){}

}