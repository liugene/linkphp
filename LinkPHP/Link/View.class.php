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
 
 namespace Link;
 class View{
 
     public function display(){
        //加载视图文件
        require CURRENT_VIEW_PATH . CONTROLLER . '/' . ACTION . '.' . C('DEFAULT_THEME_SUFFIX');
     }
     
     public function assign($filename, $value){
        //模板赋值
        
     }
     
 }

?>