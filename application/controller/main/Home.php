<?php
namespace app\controller\main;
use linkphp\Controller;
use linkphp\Application;
use Closure;
use linkphp\boot\Event;
use link\db\D;
class Home
{

    public function __construct(Controller $controller)
    {
//        dump($controller);
    }

    public function main()
    {
        dump(D::select('select * from zq_user'));die;
        Application::event(
            'test',
            [
                \app\controller\main\Event::class,
                \app\controller\main\Event::class,
                \app\controller\main\Event::class
            ]
        );
        Application::event('test');
        Application::router('index/getUser',function(){
            return 1;
        });
        dump(Application::config()->getLoadPath());
        Application::middleware('beginMiddleware',function (Closure $v) {
            $v();
            echo 3;
            return $v;
        });
        Application::middleware('beginMiddleware',function (Closure $v) {
            $v();
            echo 4;
            return $v;
        });
        Application::middleware('beginMiddleware',function (Closure $v) {
            $v();
            echo 5;
            return $v;
        });
        Application::middleware('beginMiddleware',function (Closure $v) {
            $v();
            echo 6;
            return $v;
        });
        Application::middleware('beginMiddleware',function (Closure $v) {
            $v();
            echo 7;
            return $v;
        });
        Application::middleware('beginMiddleware');die;
//        Application::input('get.in',function($value){
//            //闭包实现
//            //这里写具体的过滤方法
//            //自定义
//            //记得返回处理好的
//            return $value;
//        });
//        dump(Application::httpRequest()->isGet());
	}
}