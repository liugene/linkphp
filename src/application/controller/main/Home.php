<?php
namespace app\controller\main;
use framework\Controller;
use framework\Application;
use Closure;
use linkphp\event\Event;
use Db;
use Console;
use Config;
use framework\Exception;
use phprpc\PhpRpcClient;
use Router;

class Home extends Controller
{

//    public function __construct(Controller $controller)
//    {
//        dump($controller);
//    }

    public function main1()
    {
        return Application::view('main/home/main',[
            'linkphp' => 'linkphp'
        ]);
    }

    public function main()
    {
        dump(app()->input('get.'));die;
        Router::get('/index/index/index', '/index/api/index');
        Router::post('/index/index/index', '/index/api/index');
        Router::delete('/index/index/index', '/index/api/index');
        Router::patch('/index/index/index', '/index/api/index');
        Router::put('/index/index/index', '/index/api/index');
//        throw new Exception('test');
//        dump(new PhpRpcClient());die;
//        dump(Config::get('app.app_debug'));
//        return 'linkphp start';
//        return ['code' => 1, 'msg' => 'linkphp start'];
//        $filename = ROOT_PATH . 'src/resource/view/main/home/main.html';
//        return file_get_contents($filename);
        Application::view('main/home/main',[
            'linkphp' => 'linkphp'
        ]);
//        dump(app()->getContainerInstance());die;
//        dump(Config::get(''));die;
//        dump(Db::table('lp_download')->sum('id'));die;
//        dump(Db::table('lp_download')->count('id'));die;
//        dump(Db::select('select * from lp_download a
//left join lp_down_item b on a.id = b.down_id
//left join lp_user c on a.u_id = c.id where a.id = ?',[1])->get());die;
        return Db::table('lp_download a')
            ->join('left join lp_down_item b on a.id = b.down_id')
//            ->join('left join lp_user c on a.u_id = c.id')
            ->leftJoin('lp_user c on a.u_id = c.id')
            ->where('a.id>1')
            ->select();
        dump(Db::table('lp_download a')
            ->join('left join lp_down_item b on a.id = b.down_id')
//            ->join('left join lp_user c on a.u_id = c.id')
            ->leftJoin('lp_user c on a.u_id = c.id')
            ->where('a.id>1')
            ->select());
            dump(Db::table('lp_download')->getLastSql());die;
//        dump(Db::select('select * from lp_user where id = ?',[1])->get());die;
//        dump(Db::table('lp_user')->where('id=3')->delete());die;
//        dump(Db::table('lp_user')->where('id = 1')->setInc('pass_word'));die;
//        dump(Db::table('lp_user')->where('id=1')->update(
//            ['user_name' => 'bananabook','pass_word' => '123']
//        ));
//        dump(Db::getTable());die;
        dump(Db::table('lp_user')->field('id')->where('id = 1')->find());
        dump(Db::table('lp_user')->field('id')->where('id = 1')->select());die;
//        dump(Application::db()->select('select id from lp_forum '));die;
//        dump(Application::db()->table('lp_forum')->field('id')->select());die;
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