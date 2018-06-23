<?php

return [
    // HttpServer
    'daemon' =>  'linkphp\\console\\daemon\\HotReload',
    'server' => [
        // 类路径
        'class'        => 'linkphp\swoole\Reload',
        // 运行时的各项参数：https://wiki.swoole.com/wiki/page/274.html
        'setting'      => [
            // PID 文件
            'pid_file'    => RUNTIME_PATH . 'run/hot-reload.pid',
            // 日志文件路径
            'log_file'    => RUNTIME_PATH . 'tmp/hot-reload.log',
            // 子进程运行用户
            /* 'user'        => 'www', */
        ]
    ]
];