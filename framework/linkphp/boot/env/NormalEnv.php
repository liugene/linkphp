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
// |               正常模式
// +----------------------------------------------------------------------

namespace linkphp\boot\env;
use linkphp\boot\interfaces\EnvInterface;
use linkphp\boot\Router;
class NormalEnv implements EnvInterface
{
    public function Env()
    {
        //路由初始化
        Router::initialize();
    }
}