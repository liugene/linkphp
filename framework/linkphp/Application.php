<?php

namespace linkphp;

use linkphp\boot\Env;
use linkphp\system\core\Engine;
use linkphp\boot\Component;
use linkphp\boot\Definition;

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
                ->setClassName('linkphp\\boot\\Env')
            );
            Component::bind((new Definition())
                ->setAlias('request')
                ->setIsSingleton(true)
                ->setClassName('linkphp\\boot\\http\\Restful')
            );
            Engine::initialize();
            //初次初始化执行改变属性值为true
            self::$_init = new self();
        }
        return self::$_init;
    }

    public function check(Env $env)
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

    static public function Router()
    {
        return Component::get('run');
    }

    static public function env()
    {
        return Component::get('env');
    }

    static public function httpRequest()
    {
        return Component::get('request');
    }

    static public function get($alias)
    {
        return Component::get($alias);
    }

}