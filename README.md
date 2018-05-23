```php

 _        _                                 
| |      | |   _      __   / /_   __
| |  ___ | | /  /   / __ \/ __ \/ __ \
| | | \ \| |/  /   / /_/ / / / / /_/ /
| |_| |\ V |\  \  / .___/_/ /_/ .___/
|_____| \ _' \ _\/_/         /_/


```

###开发使用帮助文档：http://wiki.linkphp.cn
#### LinkPHP (临克) 是面向对象的轻量级常驻内存型PHP API开发框架 ，遵循Apache2开源协议发布。 开发者可以基于LinkPHP框架开发任何免费或者商用项目。

## **使用交流**
LinkPHP开发动态：www.linkphp.cn


###目前框架空目录都是必须创建的目录根据命名规范即可自动寻址加载相关文件

## **部署条件**
1、PHP版本不能小于5.5版本建议7.0版本(框架作者可能会发疯强制升级到php7)

## **支持的服务器和数据库环境**

支持Windows/Unix服务器环境
可运行于包括Apache、IIS和nginx在内的多种WEB服务器和模式
框架默认只支持Mysql数据库后期可扩展,需安装相关Pdo扩展

## **支持composer**

请确保服务器环境支持composer

在linkphp项目根目录执行 composer install命令，安装框架执行所需的所有依赖库

## **使用方法**

####事件使用

```php

use linkphp\Application;

//接收两个参数，第一个参数为标签，第二个参数可以一组类的数组也可以为类名

Application::event(
    'test',
    [
        \app\controller\main\Event::class,
        \app\controller\main\Event::class,
        \app\controller\main\Event::class
    ]
);

//事件类必须实现EventServerProvider接口中update，该方法接收EventDefinition对象参数，在update方法最后将其赋值给的变量做返回操作

use linkphp\event\EventDefinition;
use linkphp\event\EventServerProvider;

class Event implements EventServerProvider
{
    public function update(EventDefinition $definition)
    {
        dump(2);
        return $definition;
        // TODO: Implement update() method.
    }
}

//事件触发

Application::event('test');

//在不给定第二个参数时则认定为触发操作

//事件配置使用方法

//在框架的configure目录下有个event.php事件配置文件

return [
    //事件标签
    //'server' => [
        //执行事件类
    //  '\app\controller\main\Event::class';
    //]
//    'test' => [
//        '\app\controller\main\Event::class',
//    ]
];

```

#### 数据库使用说明

```php
use linkphp\db\Db;
use linkphp\Application;

//助手函数链式操作方法
db()->table('')->where('')->select();
db()->table('zq_user')->where('id=11')->delete();
//占位操作
db()->select('select * from test_table where id = ?',[1]);

//Db类链式操作
Db::table('')->field('')->where('')->select();
Db::table('zq_user')->where('id=11')->delete();
//占位操作
Db::select('select * from test_table where id = ?',[1]);

//Application类操作
Application::db()->table('')->where('')->select();
Application::db()->table('zq_user')->where('id=11')->delete();
//占位操作
Application::db()->select('select * from test_table where id = ?',[1]);

```

#### 自动加载使用说明

```php

//类加载使用方法

//configure目录下存在map.php配置文件

return [
    //psr4命名空间注册
    'autoload_namespace_psr4'   =>  [
        'app\\'         =>  [
            ROOT_PATH . 'application'
        ],
        'bootstrap\\'         =>  [
            ROOT_PATH . 'bootstrap/bootstrap'
        ],
        'linkphp\\'               =>  [
            FRAMEWORK_PATH . 'linkphp'
        ],
    ],
    //psr0命名空间
    'autoload_namespace_psr0' => [
        //'命名空间' => '映射路径地址'
    ],
    //指定自动加载机制排序
    'autoload_namespace_file' => [
        //'文件名' => '映射路径地址'
        'app_func'                => LOAD_PATH . 'common.php',
        'framework_func'          => FRAMEWORK_PATH . 'helper.php'
    ],
    'class_autoload_map' => [
        //'类名' => '类文件地址'
    ],
];

//建议使用psr4标准注册自己的相关命名空间

//如需指定加载相关文件将其放入 autoload_namespace_file下，指定到具体的文件名，框架启动便会扫描加载进框架内

```

#### restful使用说明

```php
use linkphp\Application;

//使用linkphp开发api应用

//目前框架支持3种格式输出,默认输出方式为json,其余为xml、以及view

//需要输出相关格式内容只需要在configure.php配置文件中进行配置

//然后在控制器中方法下使用

return ['test' => 'test'];

//将数组进行返回，框架的response类会根据配置的信息进行相应的格式转换进行返回给请求者

//判断当前请求方式可使用框架封装的

Application::httpRequest()->isGet();

request()->isGet();

//支持一下方式判断

request()->isGet();
request()->isPost();
request()->isDelete();
request()->isPut();
request()->isHead();
request()->isOptions();
request()->isPatch();

```

#### 容器使用说明

```php

//依赖注入实现

//controller 层构造方法注入

namespace app\controller\main;

use linkphp\http\HttpRequest;
use linkphp\Application;

class Home
{
    public function __construct(HttpRequest $httpRequest)
    {
        dump($httpRequest);
    }
}

//通过浏览器请求到该控制器会将HttpRequest自动注入进Home控制器中

//自行手动注入  闭包注入实现
Application::singleton(
    'envmodel',
    function(){
        //自行操作最后返回一个实例对象
        return Application::get('test');
    });

//自行手动注入  类名注入
Application::singletonEager(
    'run',
    'linkphp\console\Command'
);

//获取类实例
Application::get('test');

//通过类名获取时,如果在容器内未找到实例会执行自动实例操作并返回,自动实例也会触发自动注入，如果实例对象存在依赖类会自动进行注入
Application::get('linkphp\console\Command');


Application::bind(
    Application::definition()
        ->setAlias('test')
        ->setIsEager(true)
        ->setIsSingleton(true)
        ->setClassName('classname')
);

Application::bind(
    Application::definition()
        ->setAlias('test')
        ->setIsEager(true)
        ->setIsSingleton(true)
        ->setCallBack('callback')
);

```

#### 缓存使用说明

```php

use linkphp\Application;

//获取缓存
cache('test');
Application::cache('test');

//写入缓存
cache('test','test');
Application::cache('test','test');

```

#### 参数接收使用方法

```php


use linkphp\Application;

//input参数接收操作

Application::input();

Application::input('get.');

Application::input('get.test');

Application::input('get.in',function($value){
            //闭包实现
            //这里写具体的过滤方法
            //自定义
            //记得返回处理好的
            return $value;
        });

//第一个参数为接收一个get请求参数值，第二个参数为过滤获取值，可接受一个闭包函数，自定义闭包方法，闭包函数接收一个原始get值，在其里面进行自定义过滤
//最后必须将值进行返回，执行框架默认的过滤函数

//助手函数使用

input();

input('test');

input('get.');

input('get.test',function($value){
    //闭包实现
    //这里写具体的过滤方法
    //自定义
    //记得返回处理好的
    return $value;
});

request()->input('get.');

request()->input('get.',function($value){
    //闭包实现
    //这里写具体的过滤方法
    //自定义
    //记得返回处理好的
    return $value;
});

```

#### 中间件使用说明

```php

use linkphp\Application;
//中间件使用

//框架中实现了6个中间件

//configure目录下middleware.php中间件配置文件中

return [

    'beginMiddleware'          => [
        \app\controller\main\Index::class,
        \app\controller\main\Test::class,
        \app\controller\main\First::class,
    ],

    'appMiddleware'            => [
        \app\controller\main\Index::class,
    ],

    'modelMiddleware'          => [
        \app\controller\main\Test::class,
    ],

    'controllerMiddleware'     => [
        \app\controller\main\Test::class,
    ],

    'actionMiddleware'         => [
        \app\controller\main\Test::class,
    ],

    'destructMiddleware'       => [
        \app\controller\main\Test::class,
    ],

];

//分别为 框架启动中间件、应用启动中间件、模块初始化中间件、控制器初始化中间件、方法调用中间件以及框架销毁前中间件

//使用中间件的类必须实现handle方法，接收一个闭包参数最后都必须把闭包赋值的变量做返回操作

use Closure;

class Index
{
    public function handle(Closure $next)
    {
        dump('middleware index');
        return $next;
    }
}

//闭包使用方法

Application::middleware('beginMiddleware',function (Closure $v) {
    $v();
    echo 3;
    return $v;
});

```

#### 路由使用说明

```php

use linkphp\Application;
//路由使用

//在configure目录下route.php路由配置文件中进行配置使用

return [
    '/main/home/main'   =>  function(\linkphp\router\Router $router){
        return '/main/home/main';
    },
];

//键名为当前请求的路径
//键值接收字符串或者闭包函数


//闭包使用方法

Application::router('index/getUser',function(){
    return 1;
});

```

#### 视图使用说明

```php

use linkphp\Application;
//view层使用

Application::view('main/home/main',[
    'linkphp' => 'linkphp'
]);

//助手函数使用方法

//加载页面
view('main/home/main');

//加载页面并传值
view('main/home/main',['linkphp' => 'linkphp']);

```

#### 命令行使用说明

```php

首先请保证已经将执行目录切换到linkphp框架目录，默认执行
php cli如果已经将cli文件更换为自定义名称则执行自定义的名称

php cli +命令名

系统内置了些许方法可参考手册查找，如果需要自定义命令名则需要做一下几步：

1、在configure目录中打开command.php文件，添加命令类
2、在新增的命令类中按照系统给定的方式进行创建类文件
（假如自定义命令类为 app\command\main\Tset）

namespace app\command\main;

use linkphp\Application;
use linkphp\console\Command;

class Test extends Command
{

    public function configure()
    {
        $this->setAlias('test')->setDescription('test');
    }

    public function execute()
    {
        Application::get('linkphp\console\command\Output')->writeln('this is test');
    }
    
    //如果需要在该命令中添加更多方法则需要集成该方法
    public function commandHandle(){}
}

```
