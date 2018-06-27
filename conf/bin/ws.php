<?php

return [
    // HttpServer
    'daemon' =>  'linkphp\\console\\daemon\\WS',
    'server' => [
        // 类路径
        'class'        => 'linkphp\swoole\websocket\WebSocketServer',
        // 主机
        'host'         => '127.0.0.1',
        // 端口
        'port'         => 9510,
        // 运行时的各项参数：https://wiki.swoole.com/wiki/page/274.html
        'setting'      => [
            // 连接处理线程数
            'reactor_num' => 1, //reactor thread num
            'worker_num' => 1,    //worker process num
            'backlog' => 128,   //listen backlog
            'max_request' => 1,
            'dispatch_mode' => 1,
            // PID 文件
            'pid_file'    => RUNTIME_PATH . 'run/ws.pid',
            // 日志文件路径
            'log_file'    => RUNTIME_PATH . 'log/ws.log',
            // 子进程运行用户
            /* 'user'        => 'www', */
        ]
    ]
];