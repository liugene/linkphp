<?php

namespace util\wechat;
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

class WeiXin{

       public function index()
       {
             //获得参数 signatrue token timestamp echostr
             $nonce     = $_GET['nonce'];
             $token     = 'Linkphp';
             $timestamp = $_GET['timestamp'];
             $echostr   = $_GET['echostr'];
             $signatrue = $_GET['signat  rue'];
             //形成数组。然后按字典序排序
             $array = array();
             $array = array($nonce,$timestamp,$token);
             sort($array);
             //拼接成字符串，使用sha1加密，然后与signatrue进行校验
             $str = sha1(implode($array));
             if($str == $signatrue){
                 echo $echostr;
                 exit;
             }

       }
       public function reponseMsg()
         {
             //1、获取微信推送过来的POST数据(xml格式)
             $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
             //2、处理消息类型，并设置回复类型和内容
             $postObj = simplexml_load_string($postArr);
             //$postObj->ToUserName = '';
             //$postObj->FromUseName = '';
             //$postObj->CreateTime = '';
             //$postObj->MsgType = '';
             //$postObj->Event = '';
             //判断该数据包是否为订阅的事件推送
             if(strtolower($postObj->MsgType) == 'event'){
                 //如果是关注subscribe事件
                 if(strtolower($postObj->Event) == 'subscribe'){
                     //回复用户消息
                     $toUser = $postObj->FormUserName;
                     $formUser = $postObj->ToUserName;
                     $time = time();
                     $msgType = 'text';
                     $content = '欢迎关注';
                     $template = "

                     ";
                     $info = sprintf($template,$toUser,$formUser,$time,$msgType,$content);
                 }
                 //扫描带参数二维码时间如果是重扫二维码
                 if(strtolower($postObj->Event) == 'scan'){
                     if($postObj->EventKey == 2000){
                         //如果是临时二维码扫码
                         $tmp = '临时二维码';
                     }
                     if($postObj->EventKey == 300){
                         //如果是永久二维码扫码
                         $tmp = '永久二维码';
                     }
               }
           }
           //接收用户发送过来的信息进行比较然后回复文本内容
           if(strtolower($postObj->MsgType) == 'text')
           {
               if(strtolower($postObj->Content) == 'LinkPHP'){
                   $template = "";
                   $formUser = $postObj->ToUserName;
                   $toUser = $postObj->FormUserName;
                   $time = time();
                   $content = 'LinkPHP是一个开源的轻便框架';
                   $msgType = 'text';
                   $info = sprintf($template,$formUser,$toUser,$time,$content,$msgType);

               }
           }
           if(strtolower($postObj->MsgType) == 'text'){
               switch(trim($postObj->Content)){
                   case 1:
                   $content = '您输入的数字是1';
                   break;
                   case 2:
                   $content = '您输入的数字是2';
                   break;

               }
               $template = "";
               $formUser = $postObj->ToUserName;
               $toUser = $postObj->FormUserName;
               $time = time();
               //$content = '';
               $msgType = 'text';
               $info = sprintf($template,$formUser,$toUser,$time,$content,$msgType);
           }
           if(strtolower($postObj->MsgType) == 'text'){
               if(strtolower($postObj->Content) == '图文'){
               $toUser = $postObj->FormUserName;
               $formUser = $postObj->ToUserName;
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
       public function http_curl()
       {
           //获取LinkPHP
           //1、初始化curl
           $ch = curl_init();
           $url = 'http://www.1.com';
           //2、设置curl的参数
           curl_setopt($ch,CURLOPT_URL,$url);
           curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
           //3、采集
           $output = curl_exec($ch);
           //4、关闭
           curl_close($ch);
       }
       public function getWxAccessToken()
       {
           //1、请求access_token地址
           $appid = '';
           $appsecret = '';
           $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET';
           //2、初始化
           $ch = curl_init();
           //3、设置参数
           curl_setopt($ch,CURLOPT_URL,$url);
           curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
           //4、调用接口
           $res = curl_exec($ch);
           //5、关闭curl
           curl_close($ch);
           if(curl_errno($ch)){
               echo curl_error($ch);

           }
       }
       public function getWxserverIp()
       {
           $accessToken = "";
           $url = "";
           $ch = curl_init();
           curl_setopt($ch,CURL_URL,$url);
           curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
           $res = curl_exec($ch);
           curl_close($ch);
           if(curl_errno($ch)){
               var_dump(curl_error($ch));
           }
       }
       //获取微信模板消息
       public function sendTemplateMsg()
       {
           //获取到access_token
           $access_token = $this->getWxAccessToken();
           $url = "";
           //组装数组
           $array = array(
             'touser' => '',
             'template_id' => '',
             'url' => '',
             'data' => array(
                'name' => array('value' => 'hello','color' => '#000'),
                'money' => array('value' => 100,'color' => '#000'),
                'data' => array('value' => date('Y-m-d H:i:s'),'color' => '#000'),
             ),
           );
           //将数组转成json格       式
           $postJson = json_encode($array);
           //调用curl函数
           $this->http_curl();

       }
}


?>