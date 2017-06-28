<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *               LinkPHP核心图片处理类               *
 * --------------------------------------------------*
 */
 
 class Image{
    /**
     * 指定缩放比例
     * 最大宽度最大高度，等比例缩放
     * 可以对缩约图文件添加前缀
     * 选择是否删除缩约图的源文件
     */
     /**
      * 返回图片信息
      * @param string $filename[文件名]
      * @return array 包含图片的宽度、高度、创建和输出的字符串以及扩展名
      */
     function getImageInfo($filename){
        if(@!$info = getimagesize($info)){
            exit('文件不是真实图片');
        }
        $fileInfo['width'] = $info[0];
        $fileInfo['height'] = $info[1];
        $mime = image_type_to_mime_type($info[2]);
        $createFun = str_replace('/', 'createfrom', $mime);
        $outFun = str_replace('/', null, $mime);
        $fileInfo['createFun'] = $createFun;
        $fileInfo['outFun'] = $outFun;
        $fileInfo['ext'] = strtolower(image_type_to_extension($info[2]));
        return $fileInfo;
     }
     /**
      * 生成缩略图
      * @param [string] $filename 文件名
      * @param [string] $dest 默认缩略图保存路径，默认保存在thumb目录下
      * @param [string] $pre 默认前缀为thumb_
      * @param [type] dst-w 最大宽度
      * @param [type] dst_h 最大高度
      * @param [float] $scale 默认的缩放比例
      * @param [boolean] $delSource 是否删除源文件的标志
      * return [type] 返回最终保存路径以及文件名
      */
  function thumb($filename, $dest = 'thumb', $pre = 'thumb_', $dst_w = null, $dst_h = null, $scale = 0.5, $delSource = false){
     //$filename = '1.png'; 
     //$scale = 0.5; 
     //$dst_w = 200;
     //$dst_h= 300;
     //$dest = 'thumb';
    // $pre = 'thumb_';
     //$delSource = false;
     $fileInfo = getImageInfo($filename);
     $src_w = $fileInfo['width'];
     $src_h = $fileInfo['height'];
     if(is_numeric($dst_w) && is_numeric($dst_h)){
        $ratio_orig = $src_w / $sec_h;
        if($dst_w / $dst_h > $ratio_orig){
            $dst_w = $dst_h * $ratio_orig;
        } else {
            $dst_h = $dst_w / $ratio_orig;
        }
     } else {
        //没有指定按默认的缩放比例处理
        $dst_w = ceil($src_w * $scale);
        $dst_h = ceil($src_h * $scale);
     }
     $dst_image = imagecreatetruecolor($dst_w, $dst_h);
     $src_image = $fileInfo['createForm']($filename);
     imagecopyresampled();
     //检测目标目录是否存在,不存在则创建
     if($dest && !file_exists($dest)){
        mkdir($dest, 0777, true);
     }
     $randNum = mt_rand(100000,9999999);
     
     $dstName = "{$pre}{$randNum}" . $fileInfo['ext'];
     $destination = $dest ? $dest . '/' . $dstName : $dstName;
     $fileInfo['outFun']($dst_image, $destination);
     imagedestroy($src_image);
     imagedestroy($dst_image);
     if($delSource){
        @unlink($filename);
     }
     return $destination;
     }
     
    /**
     * 文字水印
     * @param [string] $filename 文件名
     * @param [string] $fontfile 文件字体
     * @param [string] $text 水印文字
     * @param [string] $dest 目标图片保存目录
     * @param [string] $pre 目标图片保存前缀
     * @param [integer] $r
     * @param [integer] $g
     * @param [integer] $b
     * @param [integer] $alpha
     * @param [integer] $angle
     * @param [integer] $size
     * @param [integer] $x
     * @param [integer] $y
     * @return [string] 目标文件保存路径以及文件名
     */
   function water_text(){  
     $filename = '1.png';
     $r = 255;
     $g = 0;
     $b = 0;
     $alpha = 60;
     $size = 30;
     $angle = 0;
     $x = 0;
     $y = 30;
     $fontfile = '';
     $text = 'LinkPHP';
     $fileInfo = getImageInfo($filename);
     $image = $fileInfo['createFun']($filename);
     $color = imagecolorallocatealpha();
     imagettftext();
     $dest = 'writeText';
     $pre = 'waterText_';
     $dstName = "{$pre}{$randNum}" . $fileInfo['ext'];
     $destination = $dest ? $dest . '/' .$dstName : $dstName;
     $fileInfo['outFun']($image, $destination);
     imagedestroy($image);
     return $destination;
   }
   
   /**
    * 生成图片水印
    * @param [string] $dstName 目标图片名称
    * @param [string] $srcName 源图片名称
    * @param [integer] $pos
    * @param [integer] $pct
    * @param [string] $dest 目标图片保存目录
    * @param [string] $pre 目标图片前缀
    * return [string] 目标图片保存路径以及文件名
    */
   function water_pic($dstName, $srcName, $pos = 0, $dest = 'Waterpic', $pre = 'waterpic_', $pct = 50){
    
    $dstName = '1.png';
    $srcName = '2.png';
    $pos = 0; // 0,代表左上角 ，1代表中间 2代表右上角
    $pct = 50;
    $dest = 'Wateric';
    $pre = 'waterpic_';
    $dstInfo = getImageInfo($dstName);
    $srcInfo = getImageInfo($srcName);
    $dst_im = $dstInfo['createFun']($dstName);
    $src_im = $srcInfo['createFun']($srcName);
    $src_width = $srcInfo['width'];
    $src_height = $srcInfo['height'];
    $dst_width = $dstInfo['width'];
    $dst_height = $dstInfo['height'];
    switch($pos){
        case 0:
        $x = 0;
        $y = 0;
        break;
        case 1:
        $x = ($dst_width - $src_width) / 2;
        $y = 0;
        break;
        case 2:
        $x = $dst_width - $src_width;
        $y = 0;
        break;
        case 3:
        $x =0;
        $y = ($dst_height - $src_height) / 2;
        break;
        case 4:
        $x = ($dst_width - $src_width) / 2;
        $y = ($dst_height - $src_height) / 2;
        break;
        case 5:
        $x = $dst_width - $src_width;
        $y = ($dst_height - $src_height) / 2;
        break;
        case 6:
        $x =0;
        $y = $dst_height - $src_height;
        break;
        case 7:
        $x = ($dst_width - $src_width) / 2;
        $y = $dst_height - $src_height;
        break;
        case 8:
        $x = $dst_width - $src_width;
        $y = $dst_height - $src_height;
        break;
        default:
        $x = 0;
        $y =0;
        break;
    }
    imagecopymerge($dst_im, $src_im, $x , $y, $src_width, $src_height, $pct);
    if($dest && !file_exists($dest)){
        mkdir($dest, 0777, true);
    }
    $randNum = mt_rand(100000, 999999);
    $dstName = "{$pre}{$randNum}" . $dstInfo['ext'];
    $destination = $dest ? $dest . '/' . $dstName : $dstName;
    $dstInfo['outFun']($dst_im, $destination);
    imagedestroy($dst_im);
    imagedestroy($src_im);
    return $destination;
    }
 }
 
?>