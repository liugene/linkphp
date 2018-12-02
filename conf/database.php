<?php

return [
//    'dns'      => 'mysql:host=127.0.0.1;dbname=linkphp',
    'dns'      => '',
    'host'     => Env::get('database.host', '127.0.0.1'), //一般不需要修改
    'port'     => Env::get('database.port', '3306'), //默认即可
    'dbuser'   => Env::get('database.dbuser', 'root'), //数据库用户名
    'dbpwd'    => Env::get('database.dbpwd', '123456'), //数据库密码
    'charset'  => 'utf8', //数据库编码
    'dbname'   => Env::get('database.dbname', 'linkphp'), //数据库名称
    'dbprefix' => Env::get('database.dbprefix', 'lp_'), //数据库表前缀
    'db_type'  => 'mysql', //数据库类型 默认Mysql
    // Query类
    'query'           => \linkphp\db\Query::class,
];