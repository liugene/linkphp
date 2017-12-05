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
// |               配置类
// +----------------------------------------------------------------------

namespace linkphp\boot;
use linkphp\boot\interfaces\EnvInterface;
class Env
{
    static protected $_env_object;

    //设置策略
    static public function setStrategy(EnvInterface $_env_object)
    {
        self::$_env_object = $_env_object;
    }

    //操作相应模式
    public function selectEnvModel()
    {
        self::$_env_object->Env();
    }

}