<?php

namespace linkphp;

use linkphp\boot\Env;
use linkphp\system\core\Engine;
use linkphp\boot\Component;
use linkphp\boot\Definition;

class Application
{

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

    public function request(){}

    public function response(){}

}