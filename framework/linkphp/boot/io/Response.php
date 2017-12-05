<?php

namespace linkphp\boot;
/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                    API接口通信                    *
 * --------------------------------------------------*
 */

class Response{
    
    /**
     * 综合方式封装通信数据方法
     * @param integer $code 状态码
     * @param string $message 提示信息
     * @param array $data 数据
     * @param string $type 类型
     * return string
     */
    public static function show(){
        if(!is_numeric($code)){
            return '';
        }
        
        $result = array(
           'code' => $code,
           'message' => $message,
           'data' => $data,
        );
        
        if($type == 'json'){
            self::json($code, $message, $data);
            exit;
        }elseif($type == 'array'){
            var_dump($result);
        }elseif($type == 'xml'){
            self::xmlEncode($code, $message, $data);
        }else{
            exit;
        }
    }
    
    /**
     * 按Json方式输出通信数据
     * @param integer $code 状态吗
     * @param string $message 提示信息
     * @param array $data 数据
     */
    public static function json($code, $message='', $data=array()){
        
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
          'code'    => '',
          'message' => '',
          'data'    => ''
        );
        
        echo json_encode($result);
        exit;
        
    }
    
    public static function xml(){
        header("Content-Type:text/xml");
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .= "<root>\n";
        $xml .= "<code>200</code>\n";
        $xml .= "<message>数据返回成功</message>\n";
        $xml .= "<data>\n";
        $xml .= "<id>1</id>\n";
        $xml .= "<name>LinkPHP</name>\n";
        $xml .= "</data>\n";
        $xml .= "<root>\n";
        
        echo $xml;
    }
    /**
     * 按xml方式输出通信信息
     * @param integer $code 状态码
     * @param string $message 提示信息
     * @oaram array $data 数据
     */
    public static function xmlEncode($code, $message, $data){
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
           'code' => $code,
           'message' => $message,
           'data' => $data,
        );
        
        header("Content-Type:text/xml");
        $xml =  "<root>";
        $xml .= self::xmlToEncode($data);
        $xml .= "</root>";
        echo $xml;
    }
    
    public static function xmlToEncode($data){
        $xml = $attr = "";
        foreach($data as $key => $value){
            if(is_numeric($key)){
                $attr = "id='{$key}'";
                $key = "item";
                
            }
            $xml .= "<{$key}{$attr}>";
            $xml .= is_array($value) ? self::xmlToEncode($value) : $value;
            $xml .= "</{$key}>";
        }
        return $xml;
    }
}

