<?php

/**
 * @author LinkPHP
 * @copyright 2017
 * http协议
 * php请求数据格式
 */

$host = 'www.1.com'; // host使用IP也可以
$poort = '80';
//建立连接
$link = Fsockopen($host,$port);

//处理请求数据
//请求行
define('CRLF',"\r\n");
$request_data = 'GET /index.php/Home/Index/index HTTP/1.1' . CRLF;
//请求头
$request_data .= 'Host:www.1.com' . CRLF;
$request_data .= 'User-Agent:'; 
$request_data .= 'Connection:Keep-Alive' . CRLF;
//空行表示头结束
$request_data .= CRLF;
//请求主体，GET没有主体
//向服务器发送GET请求数据
fwrite($link,$request_data);
//获取服务器的响应数据
while (!feof($link)){
   echo fgets($link,1024);
}
fclose($link);
?>