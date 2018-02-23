<?php
namespace app\controller\main;
use linkphp\Controller;
use linkphp\Application;
class Home
{

    public function __construct(Controller $controller)
    {
//        dump($controller);
    }

    public function main()
    {
//        Application::input('in',function($value){
//            //闭包实现
//            //这里写具体的过滤方法
//            //自定义
//            //记得返回处理好的
//            return $value;
//        });
        dump(Application::getInput());die;

        dump(Application::input('in',function($value){
            return trim($value);
        }));die;
	}
}