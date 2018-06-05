<?php

return [
    // HttpServer
    'daemon' =>  'phprpc\\server\\PhpRpcServer',
    'server' => [
        // 类路径
        'class'        => 'phprpc\swoole\PhpRpcServer',
        // 主机
        'host'         => '127.0.0.1',
        // 端口
        'port'         => 8868,
        // 运行时的各项参数：https://wiki.swoole.com/wiki/page/274.html
        'setting'      => [
            // 连接处理线程数
            'reactor_num' => 1, //reactor thread num
            'worker_num' => 1,    //worker process num
            'backlog' => 128,   //listen backlog
            'max_request' => 1,
            'open_length_check' => true,
            'package_length_type' => 'N',
            'package_body_offset' => 0,
            'package_length_offset' => 4,
            'package_max_length' => 2000000,
            'dispatch_mode' => 1,
            // PID 文件
            'pid_file'    => RUNTIME_PATH . 'run/phprpc.pid',
            // 日志文件路径
            'log_file'    => RUNTIME_PATH . 'tmp/phprpc.log',
            // 子进程运行用户
            /* 'user'        => 'www', */
        ]
    ]
];