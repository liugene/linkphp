<?php

return [
    // HttpServer
    'daemon' =>  'linkphp\\console\\daemon\\HttpServer',
    'server' => [
        // 类路径
        'class'        => 'linkphp\swoole\HttpServer',
        // 主机
        'host'         => '127.0.0.1',
        // 端口
        'port'         => 9508,
        // 运行时的各项参数：https://wiki.swoole.com/wiki/page/274.html
        'setting'      => [
            // 连接处理线程数
            'reactor_num' => 8,
            // 工作进程数
            'worker_num'  => 8,
            // 设置 worker 进程的最大任务数
            'max_request' => 10000,
            // PID 文件
            'pid_file'    => RUNTIME_PATH . 'run/link-httpd.pid',
            // 日志文件路径
            'log_file'    => RUNTIME_PATH . 'tmp/link-httpd.log',
            // 子进程运行用户
            /* 'user'        => 'www', */
        ],
    ]
];