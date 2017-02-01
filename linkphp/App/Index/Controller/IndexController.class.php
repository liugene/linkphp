<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                 框架默认控制器                    *
 * --------------------------------------------------*
 */
namespace Index\Controller;
use Link\Controller;
use Index\Model\IndexModel;
class IndexController extends Controller{
    public function index(){
        $index = new IndexModel();
        $result = $index -> show();
        require CURRENT_VIEW_PATH . CONTROLLER . '/' . ACTION . '.' . C('DEFAULT_THEME_SUFFIX');
        //$this->display(); 
    }
}

?>