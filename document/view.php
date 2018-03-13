<?php

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
