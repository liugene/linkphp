<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                   Smarty初始化类                  *
 * --------------------------------------------------*
 */
 
 namespace Link; 
 class Smarty{
    public function fech(){
        require LINKPHP_PATH . 'Template/Smarty/Smarty' . EXT;
        $smarty = new \Smarty();
        var_dump($smarty);
        $smarty->caching = C('TEMP_CACHE'); //设置是否启用缓存
        $smarty->template_dir = CURRENT_VIEW_PATH;
        $smarty->compile_dir = CACHE_PATH . 'Smarty/Smarty_c';
        $smarty->cache_dir = CACHE_PATH . 'Smarty/Smarty_cache';
        $smarty->display('Index/index.html');
    }
 }



?>