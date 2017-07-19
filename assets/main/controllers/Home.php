<?php
namespace assets\main\controllers;
use linkphp\bootstrap\Controller;
use extend\helper\sms\SendSms;
class Home extends Controller
{
	public function main()
    {
        $linkphp = 'linkphp框架';
        $this->assign('linkphp',$linkphp);
		$this->display();
		$model = new \assets\main\models\Index;
        $model = new \assets\base\models\Common;
        \assets\base\controllers\Common::test();
        //$model = new \assets\main\controllers\domore\Index;
        $config['alidayu_appkey'] = C('alidayu_appkey');
        $config['alidayu_appsecret'] = C('alidayu_appsecret');
        $config['alidayu_sign_name'] = C('alidayu_sign_name');
        $config['alidayu_phone_number'] = C('alidayu_phone_number');
        $config['alidayu_sms_id'] = C('alidayu_sms_id');
        $config['alidayu_sms_param'] = C('alidayu_sms_param');
        //dump($config);die;
        $result = SendSms::send($config);
        dump($result);
		dump($model);
	}
}