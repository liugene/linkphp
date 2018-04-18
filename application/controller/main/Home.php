<?php
namespace app\controller\main;
use linkphp\Controller;
use linkphp\Application;
use Closure;
use linkphp\event\Event;
use linkphp\db\Db;
class Home extends Controller
{

//    public function __construct(Controller $controller)
//    {
//        dump($controller);
//    }

    public function main()
    {
        return ['code' => 1,'msg' => 'test'];
        dump(confirm_zeeyer_compiled('zeeyer'));die;
        dump($this->view('main/home/main',['linkphp' => 'linkphp']));die;
        dump(request());
        dump(db());die;
        dump(Application::db());die;
        dump(Application::cache('test'));die;
        dump(Application::cache('test','test'));die;
        Application::view('main/home/main',[
            'linkphp' => 'linkphp'
        ]);die;
        dump(Db::table('zq_user')->where('id=11')->update());die;
        dump(Db::table('zq_user')->where('id=11')->delete());die;
        dump(Db::table('zq_user')->insertAll([['id' => 1,'test' => 'test'],['id' => 1,'test' => 'test']]));die;
        dump(Db::insert('insert into zq_user id values 1'));die;
        dump(Db::table('zq_user')->insert(['id' => 1]));die;
        dump(Db::table('zq_user')->field('id')->where('id = 11')->select());die;
        dump(Db::table('zq_user')->getLastSql());die;
        dump(Db::select('select * from zq_user'));
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