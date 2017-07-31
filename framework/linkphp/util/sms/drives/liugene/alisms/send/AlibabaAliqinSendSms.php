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
// |               短信发送类
// +----------------------------------------------------------------------

namespace util\sms\drives\liugene\alisms\send;
use util\sms\drives\liugene\alisms\CreateSign;
class AlibabaAliqinSendSms
{
    //获取配置请求阿里云通信短信发送地址
    static public function request($config)
    {
        $test = CreateSign::Create($config);
        dump($test);die;
    }

}
