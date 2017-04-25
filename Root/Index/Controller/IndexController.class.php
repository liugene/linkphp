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
use H;
use S;
use Q;
class IndexController extends Controller{
    public function index(){
        $model = new \Link\Model();
        $model = $model->where('where id>35')->field('id')->table('AEG_orders')->find();
        dump($model);
        H::name();
        S::name();
        Q::name();
        echo LINKPHP_VERSION;
        echo '<br />';
        $test = 'Linkphp.cn-LinkPHP创建成功';
        $this->assign('linkphp',$test);
        $this->display();
        //$this->show();
    }
}

?>