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
    'session_on' => true,
    // session 保存时间
    'expire'    => 86400,
    // session 保存路径
    'path'      => '/',
    // session 有效域名
    'domain'    => 'zuanqun.com',
    //  session 启用安全传输
    'secure'    => false,
    // httponly设置
    'httponly'  => '',
];