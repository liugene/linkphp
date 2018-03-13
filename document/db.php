<?php

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
