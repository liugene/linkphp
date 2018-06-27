<?php

return [
    // 驱动方式
    'type'   => 'File',
    // 缓存保存目录
    'path'   => RUNTIME_PATH . 'temp/temp_cache/',
    // 缓存前缀
    'prefix' => '',
    // 缓存有效期 0表示永久缓存
    'expire' => 0,
    'ext' => '.php'
];