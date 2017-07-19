<?php

namespace linkphp\bootstrap;
// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liugene <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               命令行类
// +----------------------------------------------------------------------

class Command
{
    static public function init()
    {
        if(isset($_SERVER['SHELL'])){
            print_r($_SERVER['argv']);
            print_r($_SERVER['argc']);
            exit;
        }
    }
}
