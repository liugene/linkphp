<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                  Links模板引擎类                  *
 * --------------------------------------------------*
 */

namespace linkphp\boot\view\engine;

use linkphp\boot\view\Engine;

class Link extends Engine
{
    /**
     * 模板编译文件
     * */
    private $temp_c;
    /**
     * 模板编译文件内容
     * */
    private $temp_content;
    /**
     * 模板复制变量
     * */
    private $tVar = [];
    /**
     * 左界定符号
     * */
    private $left_limit;
    /**
     * 右界定符号
     * */
    private $right_limit;
    public function __construct()
    {
        $this->_leftlimit = C('SET_LEFT_LIMITER');
        $this->_rightlimit = C('SET_RIGHT_LIMITER');
    }
    /**
     * 模板编译
     * */
    private function fetch($tempfile)
    {
        $CompileFile = file_get_contents($tempfile);
        $pregRule_L = '#' . $this->left_limit . '#';
        $pregRule_R = '#' . $this->right_limit . '#';
        $this->temp_content = preg_replace($pregRule_L,'<?php echo ',$CompileFile);
        $this->temp_content = preg_replace($pregRule_R,'; ?>',$this->temp_content);
        $this->temp_c = RUNTIME_PATH . 'temp/temp_c/' . md5($tempfile) . '.c.php';
        file_put_contents($this->temp_c,$this->temp_content);
    }
    /**
     * 加载视图方法
     * */
    public function display($tempfile='',$name='',$value='')
    {
        $filename = $tempfile == '' ? CURRENT_VIEW_PATH . '/' . CONTROLLER . '/' . ACTION  . C('DEFAULT_THEME_SUFFIX') : $tempfile;
        $this->fetch($filename);
        //加载视图文件
        // 模板阵列变量分解成为独立变量
        extract($this->tVar);
        if(file_exists($filename)){
            include $this->temp_c;
        } else {
            throw new \Exception($filename . '视图文件不存在');
        }
    }
    /**
     * 模板赋值
     * */
    public function assign($name,$value)
    {
        $this->tVar[$name] = $value;
    }
}