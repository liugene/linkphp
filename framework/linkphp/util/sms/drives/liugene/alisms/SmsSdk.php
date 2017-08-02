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

namespace util\sms\drives\liugene\alisms;
use util\sms\drives\liugene\alisms\request\ProfileRequest;
use util\sms\drives\liugene\alisms\send\AlibabaAliqinSendSms;
use util\curl\Curl;
class SmsSdk extends ProfileRequest
{
    //保存sms发送配置
    private $_sms_param = [];

    //实例化后自动设置配置
    public function __set($name,$value)
    {
        return $this->_sms_param[$name] = $value;
    }

    //发送短信
    public function send()
    {
        $request_url = AlibabaAliqinSendSms::requestUrl($this->_sms_param);
        return Curl::request('get',$request_url);
    }

}
