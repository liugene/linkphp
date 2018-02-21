<?php
namespace app\controller\main;
use linkphp\boot\Controller;
use linkphp\boot\Component;
use linkphp\boot\Definition;
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
        return ['msg' => Component::get('test')];
	}
}