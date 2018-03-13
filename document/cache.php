<?php

use linkphp\Application;

//获取缓存
cache('test');
Application::cache('test');

//写入缓存
cache('test','test');
Application::cache('test','test');
