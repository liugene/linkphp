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
class IndexController extends Controller{
    public function index(){
        $model = new \Link\Model();
        $mode = $model->field('id,cid,expoid,memo,orderstatus')->table('AEG_orders')->select();
        dump($mode);
        echo '<br />';
        echo LINKPHP_VERSION;
        //$test = 'Linkphp.cn-LinkPHP创建成功';
        //$this->assign('linkphp',$test);
        //$this->display();
        //$this->show();
    }
}

?>