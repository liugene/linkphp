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
// |               框架事件类
// +----------------------------------------------------------------------

namespace linkphp\boot;
use linkphp\boot\abstracts\EventGenerator;
class Event extends EventGenerator
{
    public function trigger()
    {
        //通知所有观察者执行
        $this->notice();
    }
}