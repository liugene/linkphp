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
namespace util\jwt;

class Jwt
{

    //数据解析
    static public function parse($string)
    {
        $data = [];
        list($header,$payload,$signature) = explode('.',$string);
        $data['header'] = static::decodeUrlByBase64($header);
        $data['payload'] = static::decodeUrlByBase64($payload);
        $data['signature'] = $string;
        return $data;
    }

    //签名
    static public function sign($payload,$key,$algo='sha256')
    {
        $sign = [];
        $sign[] = static::encodeUrlByBase64(static::json(['typ' => 'JWT', 'alg' => 'HS256']));
        $sign[] = static::encodeUrlByBase64(static::json($payload));
        $signature = implode('.',$sign);
        $sign[] = static::encodeUrlByBase64(hash_hmac($algo,$signature,$key,FALSE));
        return implode('.',$sign);
    }

    //sign验证
    static public function verify($data,$key)
    {
        $sign = static::sign(static::arrays($data['payload']),$key);
        if (function_exists('hash_equals')) {
            return hash_equals($data['signature'], $sign);
        }
        return strcmp($data['signature'],$sign);
    }

    //数据编码
    static public function encodeUrlByBase64($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'),'=');
    }

    //数据解码
    static public function decodeUrlByBase64($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    //array to json数据
    static public function json($array)
    {
        return json_encode($array);
    }

    //json to array 数据
    static public function arrays($json)
    {
        return json_decode($json,true, 512, JSON_BIGINT_AS_STRING);
    }
}