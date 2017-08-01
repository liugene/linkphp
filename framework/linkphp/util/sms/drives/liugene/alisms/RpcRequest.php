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
// |               框架启动调度类
// +----------------------------------------------------------------------

namespace util\sms\drives\liugene\alisms;
class RpcRequest extends Request
{

    //构造待请求串
    static public function constructSignature($api_prarm)
    {
        //排序
        ksort($api_prarm);
        //待请求串
        $constructSignatureString = '';
        foreach($api_prarm as $key => $value){
            $constructSignatureString .= '&' . static::replaceEncode($key) . '=' . static::replaceEncode($value);
        }
        //构造待签名的请求串
        $stringToSign = parent::getMethod() . '&' . static::replaceEncode('/') . '&' . static::replaceEncode(substr($constructSignatureString,1));
        return $stringToSign;
    }

    //处理参数
    static public function replaceEncode($str)
    {
        $res = urlencode($str);
        $res = preg_replace('/\+/', '%20', $res);
        $res = preg_replace('/\*/', '%2A', $res);
        $res = preg_replace('/%7E/', '~', $res);
        return $res;
    }

}