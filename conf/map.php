<?php

// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liugene <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               映射文件
// +----------------------------------------------------------------------

return [
    //psr4命名空间注册
    'autoload_namespace_psr4'   =>  [
	    'app\\'         =>  [
            ROOT_PATH . 'src/application'
        ],
        'bin\\'         =>  [
            ROOT_PATH . 'bin'
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
        'Db'    =>   FRAMEWORK_PATH . 'linkphp/facade/Db.php',
        'Console'    =>   FRAMEWORK_PATH . 'linkphp/facade/Console.php',
        'Component'  =>   FRAMEWORK_PATH . 'linkphp/facade/Component.php',
        'Definition'  =>   FRAMEWORK_PATH . 'linkphp/facade/Definition.php',
        'Event'  =>   FRAMEWORK_PATH . 'linkphp/facade/Event.php',
        'EventDefinition'  =>   FRAMEWORK_PATH . 'linkphp/facade/EventDefinition.php',
        'HttpRequest'  =>   FRAMEWORK_PATH . 'linkphp/facade/HttpRequest.php',
        'Config'  =>   FRAMEWORK_PATH . 'linkphp/facade/Config.php',
    ],
];