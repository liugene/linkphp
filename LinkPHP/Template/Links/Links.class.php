<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                  Links模板引擎类                  *
 * --------------------------------------------------*
 */

 class Links
 {
     /**
      * 模板编译文件
      * */
     private $_temp_c;
     /**
      * 模板编译文件内容
      * */
     private $_temp_content;
     /**
      * 模板复制变量
      * */
     private $_tVar = array();
     /**
      * 左界定符号
      * */
     private $_leftlimit;
     /**
      * 右界定符号
      * */
     private $_rightlimit;

     public function __construct()
     {
         $this->_leftlimit = C('SET_LEFT_LIMITER');
         $this->_rightlimit = C('SET_RIGHT_LIMITER');
     }

     /**
      * 模板编译
      * */
     private function fetch($tempfile)
     {
         $CompileFile = file_get_contents($tempfile);
         $pregRule_L = '#' . $this->_leftlimit . '#';
         $pregRule_R = '#' . $this->_rightlimit . '#';
         $this->_temp_content = preg_replace($pregRule_L,'<?php echo ',$CompileFile);
         $this->_temp_content = preg_replace($pregRule_R,'; ?>',$this->_temp_content);
         $this->_temp_c = CACHE_PATH . 'Temp/Temp_c/' . md5($tempfile) . '.c.php';
         file_put_contents($this->_temp_c,$this->_temp_content);
     }

     /**
      * 加载视图方法
      * */
     public function display($tempfile=null,$name=null,$value=null)
     {
         $filename = is_null($tempfile) ? CURRENT_VIEW_PATH . CONTROLLER . '/' . ACTION  . C('DEFAULT_THEME_SUFFIX') : $tempfile;
         $this->fetch($filename);
         header('Content-Type:text/html;charset=utf8');
         //加载视图文件
         // 模板阵列变量分解成为独立变量
         extract($this->_tVar);
         if(file_exists($filename)){
             include $this->_temp_c;
         } else {
             throw new \Exception($filename . '视图文件不存在');
         }
     }

     /**
      * 模板赋值
      * */
     public function assign($name,$value)
     {
         $this->_tVar[$name] = $value;
     }
 }