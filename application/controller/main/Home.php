<?php
namespace app\controller\main;
use linkphp\Controller;
use linkphp\boot\Component;
use linkphp\boot\Definition;
use linkphp\Application;
class Home
{

    public function __construct(Controller $controller)
    {
//        dump($controller);
//        dump(Component::getContainerInstance());
    }

    public function main()
    {
        Component::bind((new Definition())->setAlias('test')->setCallBack(function(){
            return 123;
        }));
//        dump(Component::get('event')->addObserver());
        dump(Application::Router());
//        return ['router' => Component::get('run')];
        return ['method' => Application::getRequestMethod()];
	}
}