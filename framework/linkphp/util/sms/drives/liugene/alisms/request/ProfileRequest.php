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

namespace util\sms\drives\liugene\alisms\request;
class ProfileRequest
{
    //阿里云通信请求方法
    protected $_method = 'GET';
    //API的版本，固定值，如短信API的值为：2017-05-25
    protected $_version = '2017-05-25';
    //请求类型
    protected $_protocol_type = 'http';
    //key
    protected $_access_key_id = 'LTAImI0YrC7yf9iF';
    //$accessKeySecret
    protected $_access_key_secret = 'VGwZJ71YQwgqH7JiCfus0HaJ2JebSm';
    //没传默认为JSON，可选填值：XML
    protected $_format = 'JSON';
    //建议固定值：HMAC-SHA1
    protected $_signature_method = 'HMAC-SHA1';
    //建议固定值：1.0
    protected $_signature_version = '1.0';
    //用于请求的防重放攻击，每次请求唯一
    protected $_signature_nonce;
    //请求方法
    protected $_action_name = 'Sendsms';
    //API支持的RegionID，如短信API的值为：cn-hangzhou
    protected $_region_id = 'cn-hangzhou';
    //短信接收号码
    protected $_phone_numbers;
    //短信签名
    protected $_sign_name;
    //短信模板ID
    protected $_template_code;
    //短信模板变量替换
    protected $_template_param;
    //外部流水扩展字段
    protected $_out_id;
    //请求域名
    protected $_domain = 'dysmsapi.aliyuncs.com';

    //设置秘钥
    public function setSecret($access_key_secret)
    {
        $this->_access_key_secret = $access_key_secret;
    }

    //设置秘钥id
    public function setKeyId($access_key_id)
    {
        $this->_access_key_id = $access_key_id;
    }

    //设置//阿里云通信请求方法
    public function setMethod($method)
    {
        $this->_method = $method;
    }

    //设置请求域名
    public function setDomain($domain)
    {
        $this->_domain = $domain;
    }

    //设置版本
    public function setVersion($version)
    {
        $this->_version = $version;
    }

    //设置请求方法名
    public function setActionName($action_name)
    {
        $this->_action_name = $action_name;
    }

    //设置请求类型
    public function setProtocolType($protocol_type)
    {
        $this->_protocol_type = $protocol_type;
    }
    //API支持的RegionID，如短信API的值为：cn-hangzhou
    public function setRegionId($region_id)
    {
        $this->_region_id = $region_id;
    }

    //获取请求方法名
    protected function getActionName()
    {
        return $this->_action_name;
    }

    protected function getRegionId()
    {
        return $this->_region_id;
    }

    //获取阿里云通信请求方法
    protected function getMethod()
    {
        return $this->_method;
    }

    //获取版本
    protected function getVersion()
    {
        return $this->_version;
    }

    //获取请求类型
    protected function getProtocolType($protocol_type)
    {
        return $this->_protocol_type;
    }

    //获取请求域名
    protected function getDomain($domain)
    {
        return $this->_domain;
    }

}