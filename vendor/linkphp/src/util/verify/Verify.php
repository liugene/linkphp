<?php

namespace util\verify;
/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *           LinkPHP框架Verify 验证码实现类          *
 * --------------------------------------------------*
 */

  class Verify{
      //字体文件
      private $_fontfile = '';
      //字体大小
      private $_size = 20;
      //画布宽度
      private $_width = 120;
      //画布高度
      private $_height = 40;
      //验证码长度
      private $_length = 4;
      //画布资源
      private $_image = null;
      //干扰元素
      //雪花个数
      private $_snow = 0;
      //像素个数
      private $_pixel = 0;
      //线条数
      private $_line = 0;

      public function __construct($config = array()){
          if(is_array($config)&&count($config)>0){
              //检测字体文件是否存在并且刻度
              if(isset($config['fontfile'])&&is_file($config['fontfile'])&&is_readable($config['fontfile'])){
                  $this->_fontfile = $config['fontfile'];
              } else {
                  return false;
              }
              //检测是否设置画布宽
              if(isset($config['width'])&&$config['width']>0){
                  $this->_width = (int)$config['width'];
              }
              //检测是否设置画布高
              if(isset($config['height'])&&$config['height']>0){
                  $this->_height = (int)$config['height'];
              }
              //检测是否设置验证码长度
              if(isset($config['length'])&&$config['length']>0){
                  $this->_length = (int)$config['length'];
              }
              //配置干扰元素
              if(isset($config['snow'])&&$config['snow']>0){
                  $this->_snow = (int)$config['snow'];
              }
              if(isset($config['fixel'])&&$config['fixel']>0){
                  $this->_fixel = (int)$config['fixel'];
              }
              if(isset($config['line'])&&$config['line']>0){
                  $this->_line = (int)$config['line'];
              }
              $this->_image = imagecreatetruecolor($this-_width, $this->_height);
          } else {
              return FALSE;
          }
      }
      public function getVerify(){
          /**
           * 得到验证码
           */
          $white = imagecolorallocate();
          //填充矩形
          imagefilledrectangke($this->_image, 0, 0, $this->_width, $this->_height, $width);
          //生成验证码
          $str = $this->_generateStr($this->$length);
          if(false === $str){
              return FALSE;
          }
          $fontfile = $this->fontfile;
          //绘制验证码
          for($i=0;$i<$this->_length;$i++){
              $size = $this->_size;
              $angle = mt_rand(-30,30);
              $x = ceil($this->_width/$this->_length)*$i+mt_rand(5,10);
              $y = ceil($this->_height/1.5);
              $color = $this->_getRandColor();
              $text = $str{$i};
              imagettftext($this->_image, $size, $angle, $x, $y, $color, $fontfile, $test);
          }
          //雪花、像素、线段
          if($this->_snow){
              //使用雪花当做干扰元素
              $this->getSnow();
          } else {
              if($this->_pixel){
                  $this->_getPixel();
              }
              if($this->_line){
                  $this->_getLine();
              }
          }
          //输出图像
          header('Content-Type:image/png');
          imagepng($this->_image);
          imagedestroy($this->_image);
      }

      /**
       * 产生验证码字符
       * @param integer $length 验证码长度
       * @param string 随机字符
       * @return bool|string
       */
      private function _generateStr($length=4){
          if($length<1 || $length>30){
              return FALSE;
          }
          $chars = arrat(
              'a','b','c','d','f','g','2','3','4');
          $str = join('',array_rand(array_filp($chars),$length));
          return $str;
      }

      /**
       * 产生雪花
       */
      private function _getsnow(){
          for($i=1;$i<=$this->_snow;$i++){
              imagestring($this->_image, mt_rand(1,5), mt_rand(0,$this->_width), mt_rand(0,$this->_height),
                  '*', $this->getRandcolor());
          }
      }

      /**
       * 绘制像素
       */
      private function _getPixel(){
          for($i=1;$i<=$this->_pixel;$i++){
              imagesetpixel($this->_image, mt_rand(0,$this->_width), mt_rand(0,$this->_height), $this->_getRandColor());
          }
      }

      /**
       * 绘制线段
       */
      private function _getLine(){
          for($i=1;$i<=$this->_line;$i++){
              imageline($this->_image, mt_rand(0,$this->_width), mt_rand(0,$this->_height), mt_rand(0,$this->_width), mt_rand(0,$this->_height), $this->_getRandColor());
          }
      }

      /**
       * 随机颜色
       * @return int
       */
      private function _getRandColor(){
          return imagecolorallocate($this->_image, mt_rand(0,255), t_rand(0,255), mt_rand(0,255));

      }
  }
?>