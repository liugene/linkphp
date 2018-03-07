<?php

namespace util\sms;
class SendSms
{
    public function send($config)
    {
        $c = new \TopClient;
        $c->appkey = $config['alidayu_appkey'];
        $c->secretKey = $config['alidayu_appsecret'];
        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        //$req->setExtend("");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName($config['alidayu_sign_name']);
        $req->setSmsParam($config['alidayu_sms_param']);
        $req->setRecNum($config['alidayu_phone_number']);
        $req->setSmsTemplateCode($config['alidayu_sms_id']);
        return $c->execute($req);
    }
}