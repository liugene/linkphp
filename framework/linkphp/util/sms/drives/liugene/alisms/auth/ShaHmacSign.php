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
// |               加密类
// +----------------------------------------------------------------------

namespace util\sms\drives\liugene\alisms\auth;
class ShaHmacSign
{
    static public function sign($stringToSign, $accessSecret)
    {
        return	base64_encode(hash_hmac('sha1', $stringToSign, $accessSecret, true));
    }

}
