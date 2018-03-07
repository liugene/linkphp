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

 namespace linkphp;

 use linkphp\boot\View;
 use linkphp\boot\Smarty;

 class Controller{

    /**
     * Smarty视图实例对象
     * @var smarty
     * @access protected
     */    
    protected $_smarty     =  null;
    protected $_view = null;
    protected $_links = null;
    
    public function __construct(){
        switch(config('DEFAULT_TEMP_TYPE')){
            case 0:
                //将实例化后的VIEW 类保存到 $_view 对象中 直接使用该对象调用父类中方法对象
                $this->_view = new View();
                break;
            case 1:
                //将实例化后的smarty类保存到$_smarty 对象中  直接使用该对象调用父类中方法对象
//                $this->_smarty = new Smarty;
                break;
            case 2:
                $this->_links = new \link\temp\LinkTemp();
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
        include TEMP_PATH . 'temp/success' . '.' . C('DEFAULT_THEME_SUFFIX');
        header("Refresh:$wait;URL=$url");
        //echo $info;
    }
    die;
  }
  
  protected function error($url,$info=null,$wait=3){
    if (is_null($info)){
        header('location:' . $url);
    } else{
        include TEMP_PATH . 'temp/apperror' . '.' . C('DEFAULT_THEME_SUFFIX');
        //提示后，refresh：N;URL=$URL
        header("Refresh:$wait;URL=$url");
        //echo $info;
    }
    die;
  }
  
  //display方法调用SMarty模板配置类
  /**
   * @ param [string] $tempfile 模板视图
   * @ var $name
   * @ var $value 赋值变量
   */
  protected function display($tempfile='',$name='',$value=''){
      $tempfile = $tempfile == '' ? CURRENT_VIEW_PATH . '/' . lcfirst(CONTROLLER) . '/' . ACTION  . C('DEFAULT_THEME_SUFFIX') : $tempfile;
      if(C('TOKEN_TURN_ON')){
          $token = new \System\Safe\Token();
          $token->init($tempfile);
      }
      switch(C('DEFAULT_TEMP_TYPE')){
          //0为使用原生PHP标签嵌套
          case 0:
          //调用赋值方法
          $this->assign($name,$value);
          $this->_view->display($tempfile);
          break;
          //1为使用Smarty模板引擎进行嵌套
          case 1:
          //调用Smarty模  板引擎赋值方法
          $this->assign($name,$value);
          $this->_smarty->init($tempfile);
          break;
          //2为使用Links模板引擎进行嵌套
          case 2:
              //调用Links模板引擎赋值方法
              $this->assign($name,$value);
              $this->_links->display($tempfile);
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
        case 2:
            $this->_links->assign($name,$value);
            break;
    }
  }
  
  /**
   * 模板输出方法可输出HTML方法
   */
  public function show($content=''){
     $this->_view->show($content);
    }
  
 }