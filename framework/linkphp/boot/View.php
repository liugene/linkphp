<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *            LinkPHP框架视图控制类                  *
 * --------------------------------------------------*
 */
 
 namespace linkphp\boot;
 class View{
    
    /**
     * 模板输出变量
     * @var tVar
     * @access protected
     */ 
    protected $_tVar     =   array();
    
    /**
     * 加载显示模板视图方法
     */
 
     public function display($tempfile='',$name='',$value=''){
        //ob_start();
        //header('Content-Type:text/html;charset=utf8');
        //ob_end_flush();
        //加载视图文件
        // 模板阵列变量分解成为独立变量
        extract($this->_tVar);
        require(CURRENT_VIEW_PATH . '/' . CONTROLLER . '/' . ACTION . '/' . ACTION . C('default_theme_suffix'));
     }
     
     /**
      * 模板赋值输出方法
      */
     public function assign($name,$value){
        //模板赋值
        $this->_tVar[$name] = $value;
     }
     
     /**
      * 模板输出方法可输出HTML方法
      */
     public function show($content=''){
        //ob_start();
        //header('Content-Type:text/html;charset=utf8');
        //ob_end_flush();
        require TEMP_PATH . 'appsuccess' . C('DEFAULT_THEME_SUFFIX');
        echo $content;
     }
 }
