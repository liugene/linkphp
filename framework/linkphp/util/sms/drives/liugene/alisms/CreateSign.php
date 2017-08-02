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
// |               生成签名类
// +----------------------------------------------------------------------

namespace util\sms\drives\liugene\alisms;
use util\sms\drives\liugene\alisms\request\RpcRequest;
use util\sms\drives\liugene\alisms\auth\ShaHmacSign;
class CreateSign
{
    //生成签名
    static public function Create($api_prarm)
    {
        $Signature = static::createSign($api_prarm);
        return $Signature;
    }

    //生成Signature
    static private function createSign($api_prarm)
    {
        $RpcRequest = new RpcRequest;
        $stringToSign = $RpcRequest->constructSignature($api_prarm);
        $accessKeySecret = $RpcRequest->getAccessKeySecret();
        $stringToSign['Signature'] = ShaHmacSign::sign($stringToSign['Signature'],$accessKeySecret . '&');
        return $stringToSign;
    }

}
