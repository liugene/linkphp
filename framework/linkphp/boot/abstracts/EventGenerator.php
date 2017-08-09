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
// |               框架事件产生者抽象类
// +----------------------------------------------------------------------

namespace linkphp\boot\abstracts;
use linkphp\boot\interfaces\EventInterface;

abstract class EventGenerator
{
    //保存观察者存入数组中
    static private $_observer = [];

    //添加观察者模式
    static protected function addObserver(EventInterface $EventInterface)
    {
        self::$_observer[] = $EventInterface;
    }

    protected function notice()
    {
        foreach(self::$_observer as $observer){
            $observer->execute();
        }
    }

}