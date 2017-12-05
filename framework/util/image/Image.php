<?php

namespace util\image;
/**
 * --------------------------------------------------*
 *  LhinkPHP��ѭApache2��ԴЭ�鷢��  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *               LinkPHP����ͼƬ������               *
 * --------------------------------------------------*
 */
 
 class Image{
    /**
     * ָ�����ű���
     * ��������߶ȣ��ȱ�������
     * ���Զ���Լͼ�ļ����ǰ׺
     * ѡ���Ƿ�ɾ����Լͼ��Դ�ļ�
     */
     /**
      * ����ͼƬ��Ϣ
      * @param string $filename[�ļ���]
      * @return array ����ͼƬ�Ŀ�ȡ��߶ȡ�������������ַ����Լ���չ��
      */
     function getImageInfo($filename){
        if(@!$info = getimagesize($info)){
            exit('�ļ�������ʵͼƬ');
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
      * ��������ͼ
      * @param [string] $filename �ļ���
      * @param [string] $dest Ĭ������ͼ����·����Ĭ�ϱ�����thumbĿ¼��
      * @param [string] $pre Ĭ��ǰ׺Ϊthumb_
      * @param [type] dst-w �����
      * @param [type] dst_h ���߶�
      * @param [float] $scale Ĭ�ϵ����ű���
      * @param [boolean] $delSource �Ƿ�ɾ��Դ�ļ��ı�־
      * return [type] �������ձ���·���Լ��ļ���
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
        //û��ָ����Ĭ�ϵ����ű�������
        $dst_w = ceil($src_w * $scale);
        $dst_h = ceil($src_h * $scale);
     }
     $dst_image = imagecreatetruecolor($dst_w, $dst_h);
     $src_image = $fileInfo['createForm']($filename);
     imagecopyresampled();
     //���Ŀ��Ŀ¼�Ƿ����,�������򴴽�
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
     * ����ˮӡ
     * @param [string] $filename �ļ���
     * @param [string] $fontfile �ļ�����
     * @param [string] $text ˮӡ����
     * @param [string] $dest Ŀ��ͼƬ����Ŀ¼
     * @param [string] $pre Ŀ��ͼƬ����ǰ׺
     * @param [integer] $r
     * @param [integer] $g
     * @param [integer] $b
     * @param [integer] $alpha
     * @param [integer] $angle
     * @param [integer] $size
     * @param [integer] $x
     * @param [integer] $y
     * @return [string] Ŀ���ļ�����·���Լ��ļ���
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
    * ����ͼƬˮӡ
    * @param [string] $dstName Ŀ��ͼƬ����
    * @param [string] $srcName ԴͼƬ����
    * @param [integer] $pos
    * @param [integer] $pct
    * @param [string] $dest Ŀ��ͼƬ����Ŀ¼
    * @param [string] $pre Ŀ��ͼƬǰ׺
    * return [string] Ŀ��ͼƬ����·���Լ��ļ���
    */
   function water_pic($dstName, $srcName, $pos = 0, $dest = 'Waterpic', $pre = 'waterpic_', $pct = 50){
    
    $dstName = '1.png';
    $srcName = '2.png';
    $pos = 0; // 0,�������Ͻ� ��1�����м� 2�������Ͻ�
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