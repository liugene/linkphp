<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                   LinkPHP基础类                   *
 * --------------------------------------------------*
 */

 namespace Link;
 class Controller{
    
    /**
     * Smarty视图实例对象
     * @var smarty
     * @access protected
     */    
    protected $_smarty     =  null;
    protected $_view = null;
    
    public function __construct(){
        if(C('DEFAULT_TEMP_TYPE') == '0'){
            $this->_view = new View();
        } else {
            $this->_smarty = new Smarty();
        }    
    }
    
    /**
     * 封装一操作成功与操作失败跳转功能
     * 公共跳转
     * 该功能应该被所有的控制器动作所共享
     * 因此将该方法写在基础控制器内
     */
    /**
     * 跳转
     * @param $url 目标URL
     * @param $info (可选)提示信息
     * @param $wait (可选)等待时间
     * @return void
     */
  protected function success($url,$info=null,$wait=3){
    if (is_null($info)){
        header('location:' . $url);
    } else{
        //提示后，refresh：N;URL=$URL
        require TTFF_PATH . 'temp/success' . '.' . C('DEFAULT_THEME_SUFFIX');
        header("Refresh:$wait;URL=$url");
        //echo $info;
    }
    die;
  }
  
  protected function error($url,$info=null,$wait=3){
    if (is_null($info)){
        header('location:' . $url);
    } else{
        require TTFF_PATH . 'temp/apperror' . '.' . C('DEFAULT_THEME_SUFFIX');
        //提示后，refresh：N;URL=$URL
        header("Refresh:$wait;URL=$url");
        //echo $info;
    }
    die;
  }
  
  //display方法调用SMarty模板配置类
  /**
   * @param [string] $tempfile 模板视图
   * @var $name 
   * @var $value 赋值变量
   */
  protected function display($tempfile='',$name='',$value=''){
    $tempfile = CURRENT_VIEW_PATH . CONTROLLER . '/' . ACTION . '.' . C('DEFAULT_THEME_SUFFIX');
    switch(C('DEFAULT_TEMP_TYPE')){
        case 0:
        $this->assign($name,$value);
        $this->_view->display($tempfile);
        break;
        case 1:
        $this->assign($name,$value);
        $this->_smarty->fetch($tempfile);
        break;
    }
  }
  
  /**
   * 视图传值赋值方法
   * @var $name
   * @var $value
   */
  protected function assign($name='',$value=''){
    switch(C('DEFAULT_TEMP_TYPE')){
        case 0:
        $this->_view->assign($name,$value);
        break;
        case 1:
        $this->_smarty->assign($name,$value);
        break;
    }
  }
  
 } 

?>