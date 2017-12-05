<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                   站点入口文件                    *
 * --------------------------------------------------*
 */
 
 namespace assets\base\models;
 use linkphp\boot\Model;
 class Common extends Model{
    public function test(){
        echo '<br />站点公共模型类测试方法 <br />';
    }
 }




?>