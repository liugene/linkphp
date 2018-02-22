<?php
namespace app\controller\main;
use linkphp\Controller;
use linkphp\Application;
class Home
{

    public function __construct(Controller $controller)
    {
        dump($controller);
    }

    public function main()
    {
        Application::bind(
            Application::definition()
                ->setAlias('test')
                ->setCallBack(function(){
                    return 123;
        }));
//        dump(Application::config());
//        dump(Application::getContainerInstance());
        dump(Application::httpRequest()->input());
        dump(Application::url('index','main'));die;
        dump(Application::input('link'));die;
        dump(Application::get('run'));die;
//        dump(Component::get('event')->addObserver());
        dump(Application::Router());
        return ['router' => Application::get('run')];
        return ['method' => Application::getRequestMethod()];
	}
}