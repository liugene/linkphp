<?php

namespace util\uploads;
/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *            LinkPHP框架表单上传控制器类           *
 * --------------------------------------------------*
 */
/**
 * @param $file array 关联数组，5个元素，临时上传的文件信息
 * @return 成功：string上传到服务器的文件名；失败：FALSE
 */

class Upload{
    
    private $_max_size;
    private $_type_map;
    private $_allow_ext_list;
    private $_allow_mime_list;
    private $_upload_path;
    private $_prefix;
    private $_error;
    
    public function getError($message){
        return $this->_error = $message;
    }
    
    public function __construct(){
        $this -> _max_size = 1024*1024;
        $this ->_type_map = array(
           '.png' => array('image/png','image/x-png'),
           '.jpg' => array('image/jpeg','image/pjpeg'),
           '.jpeg' => array('image/jpeg','image/pjpeg'),
           '.gif' => array('image/gif'),
        );
        $this -> _allow_ext_list = array('.png','.gif','.jpg');
        
    } 
    
    public function __set($p,$v){
        $allow_set_list = array(
           '_upload_path',
           '_prefix',
           '_allow_ext_list',
           '_max_size'
        );
        if (substr($p,0,1) !== '_'){
            $p = '_' . $p;
        }
        $this->$p = $v;
    }
    
    public function uploadOne($file){
        //是否存在错误
        if ($file['error'] != 0){
            $this->getError('上传出错');
            return false;
        }
        //大小
        if ($file['size'] > $this->_max_size){
            $this->getError('上传文件过大');
            return false;
        }
        
        //类型
        //保证修改允许的后缀名，就可以影响带$allow_ext_list，$allow_mime_list
        //设置一个后缀名与mime的映射元素
        //后缀从原始文件名中提取
        
        $ext = strtolower(strrchr($file['name'],'.'));
        if (!in_array($ext,$this->_allow_ext_list)){
            $this->getError('上传文件类型不合法');
            return false;
        }
        //MIME,type元素
       // $allow_mime_list = array('image/png','image/jpg');
       $allow_mime_list = array();
       foreach($allow_ext_list as $value) {
          //得到每个后缀
          $allow_mime_list = array_merge($allow_mime_list,$this->_type_map[$value]);
       }
          //去重复
          $allow_mime_list = array_unique($allow_mime_list);
        if (!in_array($file['type'],$allow_mime_list)){
            $this->getError('上传文件类型不合法');
            return false;
        }
        
        //php自己获取文件的mime，进行检测
        $finfo = new finfo(FILEINFO_MIME_TYPE); //获得一个可以检测文件mime类型信息的对象
        $mime_type = $finfo->file($file['tmp_name']); 
        
        //移动
        //上传文件存储地址
        $upload_path = './';
        //创建子目录
        $subdir = data('YmdH') . '/';
        if (!is_dir($upload_path . $subdir)) {//检测子目录是否存在
           //不存在
           mkdir($upload_path . $subdir);
            
        }
        //文件命名
        $prefix = ''; //文件前缀
        //$filename = uniqID();
        //$filename = uniqID($prefix);
        $filename = uniqID($prefix,true) . $ext;
        if (move_uploaded_file($file['tmp_name'],upload_path . $filename)){
            //移动成功
            return $subdir . $filename;
        } else {
            //移动失败
            $this->getError('移动失败');
            return false;
        }
    }
}


?>