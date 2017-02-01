<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *              LinkPHP框架初始化配置函数            *
 * --------------------------------------------------*
 */
 
 /**
  * 初始化配置函数
  * @param [string] 配置值
  * @return [string] 返回对应的值
  * 该函数仅在初始化常量配置以及相关初始化配置时使用
  * 仅在需C方法前调用框架初始配置时使用
  * 非该操作推荐使用C方法获取配置值
  */

 function init($name){
        $config['link'] = require CONF_PATH . 'conf.php';
        $config['common'] = require APPCONF_PATH . 'Config.inc.php';
        $config['conf'] = array_merge($config['link'], $config['common']);
        
        return $config['conf'][strtoupper($name)];
 }


?>