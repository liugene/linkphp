<?php
namespace assets\controllers\main;
use linkphp\boot\Controller;
use util\sms\SendSms;
use util\curl\Curl;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use system\safe\LoginAuth;
use util\redis\Redis;
use util\sms\drives\liugene\alisms\SmsSdk;
class Home extends Controller
{
	public function main()
    {
        $this->test();
        //phpinfo();die;
        //dump(\Configure::get('extend_model_config'));
        $linkphp = 'linkphp框架';
        $this->assign('linkphp',$linkphp);
		$this->display();
		//$model = new \assets\models\main\Index;
        //$model = new \assets\base\models\Common;
        \assets\base\controllers\Common::test();
        //$model = new \assets\controllers\main\domore\Index;
        //$config['alidayu_appkey'] = C('alidayu_appkey');
        //$config['alidayu_appsecret'] = C('alidayu_appsecret');
        //$config['alidayu_sign_name'] = C('alidayu_sign_name');
        //$config['alidayu_phone_number'] = C('alidayu_phone_number');
        //$config['alidayu_sms_id'] = C('alidayu_sms_id');
        //$config['alidayu_sms_param'] = C('alidayu_sms_param');
        //dump($config);die;
        //$result = SendSms::send($config);
        //$sys = \system\log\Log::save('123');
        //dump($sys);die;
        //$curl = Curl::request('get','http://www.baidu.com');
        //dump($curl);die;
        //dump($result);
		//dump($model);
        // 配置信息
        /*$config = [
            'app_key'    => C('alidayu_appkey'),
            'app_secret' => C('alidayu_appsecret'),
        ];

        $client = new Client(new App($config));
        $req = new AlibabaAliqinFcSmsNumSend;

        $req->setRecNum(C('alidayu_phone_number'))
            ->setSmsParam([
                'number' => rand(100000, 999999)
            ])
            ->setSmsFreeSignName(C('alidayu_sign_name'))
            ->setSmsTemplateCode(C('alidayu_sms_id'));


        print_r($client->execute($req));*/
        /*$token = LoginAuth::get('liujun');
        $redis = new \Redis();
        //dump($redis);die;
        $redis->connect('127.0.0.1',6379);
        $redis->setex($token,3600,'liugene');
        $result = $redis->get($token);
        dump($result);die;*/
        /*$code = rand(100000,999999);
        $sms = new SmsSdk;
        $sms->PhoneNumbers = '15558040535';
        $sms->setKeyId('Sendsms');
        $sms->SignName = '我飞网';
        $sms->TemplateCode = 'SMS_81550001';
        $sms->TemplateParam = "{'number':$code}";
        $result = $sms->send();
        var_dump($result);*/
	}
}