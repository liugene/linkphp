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
class Request
{
    //阿里云通信请求方法
    protected $_method = 'GET';
    //版本
    protected $_version;
    //请求方法名
    protected $_action_name;
    protected $_region_id;

    //设置//阿里云通信请求方法
    public function setMethod($method)
    {
        $this->_method = $method;
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

    public function setRegionId($region_id)
    {
        $this->_region_id = $region_id;
    }

    //获取阿里云通信请求方法
    public function getMethod()
    {
        return $this->_method;
    }

    //获取版本
    public function getVersion()
    {
        return $this->_version;
    }

    //获取请求方法名
    public function getActionName()
    {
        return $this->_action_name;
    }

    public function getRegionId()
    {
        return $this->_region_id;
    }

}
