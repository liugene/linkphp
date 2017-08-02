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

namespace util\sms\drives\liugene\alisms\request;
class RpcRequest extends ProfileRequest
{

    //构造请求地址
    public function constructUrl($url_param)
    {
        $url = $this->_protocol_type . "://" . $this->_domain ."/?";
        foreach($url_param as $url_param_key => $url_param_value)
        {
            $url .= $url_param_key . '=' . urlencode($url_param_value) . '&';
        }
        return substr($url, 0, -1);
    }

    //构造待请求串
    public function constructSignature($api_prarm)
    {
        $api_prarm = $this->mergeProfileName($api_prarm);
        //排序
        ksort($api_prarm);
        //待请求串
        $constructSignatureString = '';
        foreach($api_prarm as $key => $value){
            $constructSignatureString .= '&' . $this->replaceEncode($key) . '=' . $this->replaceEncode($value);
        }
        //构造待签名的请求串
        $api_prarm['Signature'] = parent::getMethod() . '&' . $this->replaceEncode('/') . '&' . $this->replaceEncode(substr($constructSignatureString,1));
        return $api_prarm;
    }

    //处理参数public function replaceEncode($str)
    public function replaceEncode($str)
    {
        $res = urlencode($str);
        $res = preg_replace('/\+/', '%20', $res);
        $res = preg_replace('/\*/', '%2A', $res);
        $res = preg_replace('/%7E/', '~', $res);
        return $res;
    }

    //获取$accessKeySecret
    public function getAccessKeySecret()
    {
        return $this->_access_key_secret;
    }

    //处理设置信息
    private function mergeProfileName($api_prarm)
    {
        $SignatureNonce = rand(10000,99999);
        date_default_timezone_set('GMT');
        $default_profile_name = ['AccessKeyId' =>  $this->_access_key_id,
                                 'Timestamp' => date('Y-m-d\TH:i:s\Z'),
                                 'Format' => $this->_format,
                                 'SignatureMethod' => $this->_signature_method,
                                 'SignatureVersion' => $this->_signature_version,
                                 'SignatureNonce' => $SignatureNonce,
                                 'Action' => $this->_action_name,
                                 'Version' => $this->_version,
                                 'RegionId' => $this->_region_id,
                                 'PhoneNumbers' => $this->_phone_numbers,
                                 'SignName' => $this->_sign_name,
                                 'TemplateCode' => $this->_template_code,
                                 'TemplateParam' => $this->_template_param,
                                 'OutId' => $this->_out_id];
        $merge_api_param = array_merge($default_profile_name,$api_prarm);
        return $merge_api_param;
    }

}