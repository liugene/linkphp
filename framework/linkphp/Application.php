<?php

namespace linkphp;

use linkphp\boot\Environment;
use linkphp\boot\Component;
use linkphp\boot\Definition;
use linkphp\boot\di\InstanceDefinition;
use Container;

class Application
{
    private $data;

    //保存是否已经初始化
    private static $_init;
    //links启动
    static public function run()
    {
        if(!isset(self::$_init)){
            Component::bind((new Definition())
                ->setAlias('env')
                ->setIsSingleton(true)
                ->setClassName('linkphp\\boot\\Environment')
            );
            (new Container())->setup();
            Component::get('middle')->import(include LOAD_PATH . 'middleware' . EXT);
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
        Component::get('request')->request()->start();
        return $this;
    }

    public function response()
    {
        Component::get('request')->request()->setData($this->data)->send();
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    static public function getRequestMethod()
    {
        return Component::get('request')->request()->getRequestMethod();
    }

    static public function router()
    {
        return Component::get('run');
    }

    static public function env()
    {
        return Component::get('env');
    }

    static public function httpRequest()
    {
        return Component::get('request')->request();
    }

    static public function get($alias)
    {
        return Component::get($alias);
    }

    static public function bind(InstanceDefinition $definition)
    {
        return Component::bind($definition);
    }

    static public function definition()
    {
        return new Definition();
    }

    static public function getContainerInstance()
    {
        return Component::getContainerInstance();
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
        return Component::get('make')->url($c,$a,$p);
    }

    static public function make()
    {
        return Component::get('make');
    }

    static public function config()
    {
        return Component::get('config');
    }

    static public function middleware($middle,$middleware=null)
    {
        if(Component::get('middle')->isValidate($middle)){
            return Component::get('middle')->$middle($middleware);
        }
    }
}