<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *               LinkPHP系统表单令牌                 *
 * --------------------------------------------------*
 */

 namespace linkphp\system\safe;
 class Token
 {

     //初始化表单令牌
     public function init($filename)
     {
         //检测是否开启表单令牌设置
         if(C('TOKEN_TURN_ON')){
             $token = $this->createToken();
             $token_name = 'md5';
             $token_key = 'md5';
             $input = '<input type="hidden" name="'. $token_name .'" value="' . $token_key  .  $token . '" />';
             $content = file_get_contents($filename);
             //检测需要表单验证的视图是否已经存在表单文本域
             if(strpos($content,$token_name)){
                 //存在令牌文本域重新获取Token
                 $token = $this->createToken();
                 //正则匹配文本域并替换
                 $input = '<input type="hidden" name="'. $token_name .'" value="' . $token_key  .  $token . '" />';
                 $content = preg_replace('#<input\s+type="hidden"\s+name="'. $token_name .'"\s+value="([a-zA-Z0-9]){1,}"\s+\/>#',$input,$content);
             } else {
                 //不存在令牌文本域则创建表单令牌文本域
                 preg_match('#<\/form>#',$content,$match);
                 $content = str_replace($match[0],$input.$match[0],$content);
                 //将token保存session用于验证
                 $_SESSION[$token_name] = $token;
             }
             file_put_contents($filename,$content);
         }
     }

     //创建token方法
     private function createToken()
     {
         $token = md5(rand(000000000000,999999999999));
         return $token;
     }

     //验证Token方法
     private function checkToken()
     {}
 }