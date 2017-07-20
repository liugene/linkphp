<?php

// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Latham <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               路由配置
// +----------------------------------------------------------------------

namespace linkphp\bootstrap\router\config;
class Config
{
    static public function get()
    {
        $config = require(WEB_PATH . 'configure/route.php');
        return $config;
    }
}

