<?php

namespace util\wechat;
use linkphp\boot\Configure;
use util\curl\Curl;
/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *              LinkPHP框架微信验证操作类            *
 * --------------------------------------------------*
 */

class WeiXin
{

    //保存access_token
    static private $access_token;
    //保存获取的access_token时间
    static private $time;
    //保存从微信post传输的xml数据
    static public $post_xml;
    //判断是否已经校验过signature | bool
    static private $isValid = false;


    //微信传输过来的所有数据都从该方法开始
    static public function receive()
    {
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            if(!static::$isValid){
                if(static::checkSignature()){
                    $post_xml = file_get_contents("php://input");
                    if(!empty($post_xml)){
                        static::$post_xml = simplexml_load_string($post_xml,'SimpleXMLElement',LIBXML_NOCDATA);
                    } else {
                        static::$post_xml = null;
                    }
                }
            }
        } else {
            if(!static::$isValid && isset($_GET['echostr'])){
                if(static::checkSignature()){
                    ob_clean();
                    echo $_GET['echostr'];
                    die;
                }
            } else {
                exit('已经校验过或者请求参数缺失!');
            }
        }
    }

    //校验签名合法性
    static private function checkSignature()
    {
        if(isset($_GET['nonce']) && isset($_GET['timestamp']) && isset($_GET['signature'])){
            //获得参数 signatrue token timestamp
            //先获取到这三个参数
            $signature = $_GET['signature'];
            $nonce = $_GET['nonce'];
            $timestamp = $_GET['timestamp'];

            //把这三个参数存到一个数组里面
            $tmpArr = array($timestamp,$nonce,'linkphp');
            //进行字典排序
            sort($tmpArr);

            //把数组中的元素合并成字符串，impode()函数是用来将一个数组合并成字符串的
            $tmpStr = implode($tmpArr);

            //sha1加密，调用sha1函数
            $tmpStr = sha1($tmpStr);
            if($tmpStr == $signature){
                static::$isValid = true;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //创建菜单
    static public function createMenu($menu)
    {
        static::getWxAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . static::$access_token;
        return Curl::request('post',$url,$menu);
    }

    //请求获access_token
    static public function getWxAccessToken()
    {
        //判断是否初次请求
        if(!isset(static::$access_token)){
            //1、请求access_token地址
            $appid = Configure::get('wx_appid');
            $appsecret = Configure::get('wx_secret');
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret . '';
            $token = json_decode(Curl::request('get',$url),true);;
            static::$access_token = $token['access_token'];
            static::$time = time();
        } else {
            $now = time();
            if(($now-static::$time)>7200){
                //1、请求access_token地址
                $appid = Configure::get('wx_appid');
                $appsecret = Configure::get('wx_secret');
                $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret . '';
                $token = json_decode(Curl::request('get',$url),true);;
                static::$access_token = $token['access_token'];
                static::$time = time();
            }
        }
    }

    static public function responseMsg()
    {
        //判断该数据包是否为订阅的事件推送
        if(strtolower(static::$post_xml->MsgType) == 'event'){
            //如果是关注subscribe事件
            if(strtolower(static::$post_xml->Event) == 'subscribe'){
                //回复用户消息
                $formUser = static::$post_xml->ToUserName;
                $toUser = static::$post_xml->FromUserName;
                $time = time();
                $msgType = 'text';
                $content = '欢迎关注linkphp';
                $template = "<xml>
 <ToUserName><![CDATA[%s]]></ToUserName>
 <FromUserName><![CDATA[%s]]></FromUserName>
 <CreateTime>%s</CreateTime>
 <MsgType><![CDATA[%s]]></MsgType>
 <Content><![CDATA[%s]]></Content>
 </xml>";
                echo sprintf($template,$toUser,$formUser,$time,$msgType,$content);
            }
            //扫描带参数二维码时间如果是重扫二维码
            if(strtolower(static::$post_xml->Event) == 'scan'){
                if(static::$post_xml->EventKey == 2000){
                    //如果是临时二维码扫码
                    $tmp = '临时二维码';
                }
                if(static::$post_xml->EventKey == 300){
                    //如果是永久二维码扫码
                    $tmp = '永久二维码';
                }
            }
        }
        //接收用户发送过来的信息进行比较然后回复文本内容
        if(strtolower(static::$post_xml->MsgType) == 'text')
        {
            if(strtolower(static::$post_xml->Content) == 'linkphp'){
                $template = "<xml>
 <ToUserName><![CDATA[%s]]></ToUserName>
 <FromUserName><![CDATA[%s]]></FromUserName>
 <CreateTime>%s</CreateTime>
 <MsgType><![CDATA[%s]]></MsgType>
 <Content><![CDATA[%s]]></Content>
 </xml>";
                $formUser = static::$post_xml->ToUserName;
                $toUser = static::$post_xml->FromUserName;
                $time = time();
                $content = 'LinkPHP是一个开源的轻便框架';
                $msgType = 'text';
                echo sprintf($template,$toUser,$formUser,$time,$content,$msgType);
            }
        }
        if(strtolower(static::$post_xml->MsgType) == 'text'){
            $content = '';
            switch(trim(static::$post_xml->Content)){
                case 1:
                    $content = '您输入的数字是1';
                    break;
                case 2:
                    $content = '您输入的数字是2';
                    break;

            }
            $template = "<xml>
 <ToUserName><![CDATA[%s]]></ToUserName>
 <FromUserName><![CDATA[%s]]></FromUserName>
 <CreateTime>%s</CreateTime>
 <MsgType><![CDATA[%s]]></MsgType>
 <Content><![CDATA[%s]]></Content>
 </xml>";
            $formUser = static::$post_xml->ToUserName;
            $toUser = static::$post_xml->FromUserName;
            $time = time();
            $msgType = 'text';
            echo sprintf($template,$toUser,$formUser,$time,$msgType,$content);
        }
        if(strtolower(static::$post_xml->MsgType) == 'text'){
            if(strtolower(static::$post_xml->Content) == '图文'){
                $toUser = static::$post_xml->FormUserName;
                $formUser = static::$post_xml->ToUserName;
                $arr = array(
                    'title' => 'Linkphp',
                    'description'=>"LinkPHP是一个php开源框架",
                    'picurl' => '',
                    'url' => 'http://www.linkphp.cn',
                );
                //回复图文消息
                $template = "<xml>
                            <ToUserName><![CDATA[toUser]]></ToUserName>
                            <FromUserName><![CDATA[fromUser]]></FromUserName>
                            <CreateTime>12345678</CreateTime>
                            <MsgType><![CDATA[news]]></MsgType>
                            <ArticleCount>.count($arr).</ArticleCount>
                            <Articles>";
                foreach ($arr as $k=>$v){
                    $template .= "<item>
                            <Title><![CDATA[".$v['title']."]]></Title>
                            <Description><![CDATA["                     .$v['description']."]]></Description>
                            <PicUrl><![CDATA[".$v['picur']."]]></PicUrl>
                            <Url><![CDATA[".$v['url']."]]></Url>
                            </item>";
                }

                $template .= "</Articles>
                     </xml>";
            }
        }
    }

    //获取微信服务器IP地址
    static public function getWxServerIp()
    {
        static::getWxAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=' . static::$access_token;
        return Curl::request('get',$url);
    }
       //获取微信模板消息
    public function sendTemplateMsg($data)
    {
        //获取到access_token
        static::getWxAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . static::$access_token;
        //将数组转成json格式
        $postJson = json_encode($data);
        return Curl::request('post',$url,$postJson);
    }
}

