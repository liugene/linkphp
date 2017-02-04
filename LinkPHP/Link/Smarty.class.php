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
    public function fetch($tempfile){
        include LINKPHP_PATH . 'Template/Smarty/Smarty' . EXT;
        $smarty = new \Smarty();
        $smarty->caching = C('TEMP_CACHE'); //设置是否启用缓存
        $smarty->setTemplateDir(CURRENT_VIEW_PATH);
        $smarty->setCompileDir(CACHE_PATH . 'Smarty/Smarty_c'); //Smarty模板引擎模板编译目录
        $smarty->setCacheDir(CACHE_PATH . 'Smarty/Smarty_cache'); //Smarty模板引擎模板缓存目录
        $smarty->setLeftDelimiter('<{'); //设置Smarty模板引擎视图中左结束符号
        $smarty->setRightDelimiter('}>'); //设置Smarty
        $smarty->display($tempfile);
    }
 }



?>