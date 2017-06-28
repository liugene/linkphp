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
 
 namespace link;
 class Smarty{
    /**
     * 模板输出变量
     * @var tVar
     * @access protected
     */ 
    protected $_tVar     =   array();
    
    public function init($tempfile){
        include EXTEND_PATH . 'library/Smarty/Smarty' . EXT;
        $smarty = new \Smarty();
        $smarty->caching = C('TEMP_CACHE'); //设置是否启用缓存
        $smarty->setTemplateDir(CURRENT_VIEW_PATH);
        $smarty->setCompileDir(CACHE_PATH . 'temp/temp_c'); //Smarty模板引擎模板编译目录
        $smarty->setCacheDir(CACHE_PATH . 'temp/temp_cache'); //Smarty模板引擎模板缓存目录
        $smarty->setLeftDelimiter(C('SET_LEFT_LIMITER')); //设置Smarty模板引擎视图中左结束符号
        $smarty->setRightDelimiter(C('SET_RIGHT_LIMITER')); //设置Smarty
        $smarty->assign($this->_tVar); //传入模板输出变量
        $smarty->display($tempfile);
    }
    
    /**
     * 模板变量赋值  公共public方法
     * @param $name 
     * @param $value
     */
    public function assign($name,$value){
        $this->_tVar[$name] = $value;
    }
 }



?>
