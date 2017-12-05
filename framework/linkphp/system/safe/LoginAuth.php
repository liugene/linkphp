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
// |               api权限类
// +----------------------------------------------------------------------

namespace linkphp\system\safe;

class LoginAuth
{
    //通过合法校验获取token并返回客户端
    static public function get($userid)
    {
        $time = time();
        return static::createTokenByUserId($userid,$time);
    }

    //用户id创建token
    static public function createTokenByUserId($userid,$time)
    {
        $token = md5($userid.$time);
        return $token;
    }

    //通过验证时间戳断言token时效性
    static public function verifyByTime(){}

}
