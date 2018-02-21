<?php
namespace app\controller\main;
use linkphp\Controller;
use linkphp\Application;
class Home
{

    public function __construct(Controller $controller)
    {
//        dump($controller);
//        dump(Application::getContainerInstance());
    }

    public function main()
    {
        Application::bind(
            Application::definition()
                ->setAlias('test')
                ->setCallBack(function(){
                    return 123;
        }));
        dump(Application::input('link'));die;
        dump(Application::get('run'));die;
//        dump(Component::get('event')->addObserver());
        dump(Application::Router());
        return ['router' => Application::get('run')];
        return ['method' => Application::getRequestMethod()];
	}
}