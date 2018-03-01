<?php

namespace linkphp\boot\router;

use Closure;

class Router
{

    /**
     * @param array $rule
     * 路由规则
     */
    private $rule = [];

    /**
     * @param string $url_module
     * url模式
     * URL模式 0普通模式 1 pathinfo模式 2 rewrite模式
     */
    private $url_module = '1';

    /**
     * @param array $url
     * 封装后请求地址
     */
    private $url = [];

    /**
     * @param array $path
     * 请求地址
     */
    private $path;

    /**
     * @param string $default_platform
     * 默认操作平台
     */
    private $default_platform = 'main';

    /**
     * @param string $default_controller
     * 默认控制器
     */
    private $default_controller = 'Home';

    /**
     * @param string $default_action
     * 默认操作方法
     */
    private $default_action = 'main';

    /**
     * @param string $var_platform
     * 默认模块传参变量
     */
    private $var_platform = 'm';

    /**
     * @param string $var_controller
     * 默认控制器传参变量
     */
    private $var_controller = 'c';

    /**
     * @param string $var_action
     * 默认方法传参变量
     */
    private $var_action = 'a';

    /**
     * @param bool $route_rules_on
     * 是否开启路由自定义配置
     */
    private $route_rules_on = true;

    /**
     * @param string $get_param
     * get参数
     */
    private $get_param;

    private $platform;

    private $controller;

    private $action;

    private $dir = APPLICATION_PATH;

    private $namespace = APP_NAMESPACE_NAME;

    /**
     * 返回的数据
     */
    private $return_data;

    public function run(Router $router){}

    public function set(Router $router)
    {
        return $this;
    }

    public function import($rules)
    {
        if(is_array($rules)){
            $this->rule($rules);
        }
        return $this;
    }

    public function rule($rule,$tag='')
    {
        if(is_array($rule)) $this->rule = array_merge($this->rule,$rule);
        if($tag instanceof Closure) $this->rule = array_merge($this->rule,[$rule => $tag]);
        if($tag!='') $this->rule = array_merge($this->rule,[$rule => $tag]);
        return $this;
    }

    public function parser()
    {
        (new Parser())->parserPath($this);
        return $this;
    }

    public function dispatch()
    {
        (new Dispatch())->dispatch($this);
        return $this;
    }

    public function setReturnData($data)
    {
        $this->return_data = $data;
        return $this;
    }

    public function setUrlModel($model)
    {
        $this->url_module = $model;
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function setDefaultPlatform($platform)
    {
        $this->default_platform = $platform;
        return $this;
    }

    public function setDefaultController($controller)
    {
        $this->default_controller = $controller;
        return $this;
    }

    public function setDefaultAction($action)
    {
        $this->default_action = $action;
        return $this;
    }

    public function setVarPlatform($platform)
    {
        $this->var_platform = $platform;
        return $this;
    }

    public function setVarController($controller)
    {
        $this->var_controller = $controller;
        return $this;
    }

    public function setVarAction($action)
    {
        $this->var_action = $action;
        return $this;
    }

    public function setRouterOn($bool)
    {
        $this->route_rules_on = $bool;
        return $this;
    }

    public function setGetParam($param)
    {
        $this->get_param = $param;
        return $this;
    }

    public function setPlatform($platform)
    {
        $this->platform = $platform;
        return $this;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    public function setDir($dir)
    {
        $this->dir = $dir;
        return $this;
    }

    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }


    /////////////////参数获取//////////////////////

    public function getReturnData()
    {
        return $this->return_data;
    }

    public function getUrlModel()
    {
        return $this->url_module;
    }

    public function getUrl($key='')
    {
        return $key == '' ? $this->url : $this->url[$key];
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getDefaultPlatform()
    {
        return $this->default_platform;
    }

    public function getDefaultController()
    {
        return $this->default_controller;
    }

    public function getDefaultAction()
    {
        return $this->default_action;
    }

    public function getVarPlatform()
    {
        return $this->var_platform;
    }

    public function getVarController()
    {
        return $this->var_controller;
    }

    public function getVarAction()
    {
        return $this->var_action;
    }

    public function getRouterOn()
    {
        return $this->route_rules_on;
    }

    public function getRule()
    {
        return $this->rule;
    }

    public function getGetParam()
    {
        return $this->get_param;
    }

    public function getPlatform()
    {
        return $this->platform;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getDir()
    {
        return $this->dir;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

}