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
use util\sms\drives\liugene\alisms\request\RpcRequest;
class AlibabaAliqinSendSms
{
    //获取配置请求阿里云通信短信发送地址
    static public function requestUrl($config)
    {
        $Signature = CreateSign::Create($config);
        return static::request($Signature);
    }

    //发送请求
    static private function request($url_param)
    {
        $RpcRequest = new RpcRequest;
        //构造请求地址并发送请求
        return $request_url = $RpcRequest->constructUrl($url_param);
    }

}
