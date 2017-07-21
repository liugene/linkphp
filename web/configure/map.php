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
    //命名空间注册
    'autoload_namespace'   =>  [
        'assets\main\controllers'         =>  array(APPLICATION_PATH . 'main/controllers'),
        'assets\main\models'              =>  array(APPLICATION_PATH . 'main/models'),
        'assets\base\models'              =>  array(APPLICATION_PATH . 'base/models'),
        'assets\base\controllers'         =>  array(APPLICATION_PATH . 'base/controllers'),
        'api\main\controllers'            =>  array(APPLICATION_PATH . 'main/controllers'),
        'api\main\models'              =>  array(APPLICATION_PATH . 'main/models'),
        'linkphp\bootstrap'               =>  array(LINKPHP_PATH . 'bootstrap'),
        'linkphp\bootstrap\router'               =>  array(LINKPHP_PATH . 'bootstrap/router'),
        'linkphp\bootstrap\handle'               =>  array(LINKPHP_PATH . 'bootstrap/handle'),
        'linkphp\bootstrap\router\config'               =>  array(LINKPHP_PATH . 'bootstrap/router/config'),
        'linkphp\bootstrap\cli\command'               =>  array(LINKPHP_PATH . 'bootstrap/cli/command'),
        //'extend\helper\sms'               =>  array(EXTEND_PATH . 'helper/sms'),
    ],
    'class_autoload_map' => [
        //'类名' => '类文件地址'
        'Configure'  => CORE_PATH . 'Configure' . EXT,
    ],
];