<?php

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

input('get.test');
