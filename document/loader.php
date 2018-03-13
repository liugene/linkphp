<?php

//类加载使用方法

//configure目录下存在map.php配置文件

return [
    //psr4命名空间注册
    'autoload_namespace_psr4'   =>  [
        'app\\'         =>  [
            ROOT_PATH . 'application'
        ],
        'bootstrap\\'         =>  [
            ROOT_PATH . 'bootstrap/bootstrap'
        ],
        'linkphp\\'               =>  [
            FRAMEWORK_PATH . 'linkphp'
        ],
    ],
    //psr0命名空间
    'autoload_namespace_psr0' => [
        //'命名空间' => '映射路径地址'
    ],
    //指定自动加载机制排序
    'autoload_namespace_file' => [
        //'文件名' => '映射路径地址'
        'app_func'                => LOAD_PATH . 'common.php',
        'framework_func'          => FRAMEWORK_PATH . 'helper.php'
    ],
    'class_autoload_map' => [
        //'类名' => '类文件地址'
    ],
];

//建议使用psr4标准注册自己的相关命名空间

//如需指定加载相关文件将其放入 autoload_namespace_file下，指定到具体的文件名，框架启动便会扫描加载进框架内
