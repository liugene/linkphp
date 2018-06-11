<?php

return [
    'id'             => '',
    // SESSION_ID的提交变量,解决flash上传跨域
    'var_session_id' => '',
    // SESSION 前缀
    'prefix'         => 'zq',
    // 驱动方式 支持redis memcache memcached
    'type'           => '',
    // 是否自动开启 SESSION
    'auto_start'     => true,
    'session_on' => true,
    //redis
    'host'         => '127.0.0.1', // redis主机
    'port'         => 6379, // redis端口
    'password'     => '', // 密码
    'select'       => 0, // 操作库
    'expire'       => 3600, // 有效期(秒)
    'timeout'      => 0, // 超时时间(秒)
    'persistent'   => true, // 是否长连接
    'session_name' => '', // sessionkey前缀
];