<?php

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
