<?php

namespace linkphp\boot\router;

use Closure;

class Parser
{

    /**
     * router类实例
     * @var \linkphp\boot\router\Router
     */
    private $_router;

    public function parserPath(Router $router)
    {
        $this->_router = $router;
        $path = $this->_router->getPath();
        /**
         * 检测URL模式以及是否开启自定义路由配置
         */
        if($this->_router->getUrlModel() != '0' && $this->_router->getRouterOn()){
            $rule = $this->_router->getRule();
            if(array_key_exists($this->_router->getPath(),$rule)){
                $path = $rule[$path];
            }
        }
        /**
         * URL参数匹配
         */
        $this->parserParam($path);
    }

    public function parserParam($path)
    {
        if($path instanceof Closure){
            $url = call_user_func($path,$this->_router);
        } elseif(is_array($path)) {
            $url = preg_replace('/\.html$/','',$path);
        } else {
            $url = preg_replace('/\.html$/','',$path);
        }
        switch($this->_router->getUrlModel()){
            case 0:
                $this->initDispatchParamByNormal($url);
                break;
            case 1:
                $dispatch = explode('/',trim($url,'/'));
                if(in_array('index.php',$dispatch)){
                    $param['platform'] = isset($dispatch['1']) ? $dispatch['1'] : '';
                    $param['controller'] = isset($dispatch['2']) ? $dispatch['2'] : '';
                    $param['action'] = isset($dispatch['3']) ? $dispatch['3'] : '';
                    $this->getValue($url,4);
                } else {
                    $param['platform'] = isset($dispatch['0']) ? $dispatch['0'] : '';
                    $param['controller'] = isset($dispatch['1']) ? $dispatch['1'] : '';
                    $param['action'] = isset($dispatch['2']) ? $dispatch['2'] : '';
                    $this->getValue($url,3);
                }
                $this->_router->setUrl($param);
                $this->initDispatchParamByPathInfo();
                break;
            case 2:
                $this->initDispatchParamByNormal($url);
                break;
        }
    }

    private function getValue($url,$start)
    {
        $get = explode('/',trim($url,'/'));
        if(count($get)>3){
            $param = array_slice($get,$start);
            for($i=0;$i<count($param);$i+=2){
                $_GET[$param[$i]] = $param[$i+1];
            }
            return $_GET;
        }
    }

    /**
     * 默认模式下初拼接分发参数
     */
    private function initDispatchParamByNormal($url){
        $get_param = $this->_router->getGetParam();
        //定义常量保存操作平台
        $this->_router->setPlatform(
            isset($get_param[$this->_router->getVarPlatform()])
                ?
                strtolower($get_param[$this->_router->getVarPlatform()])
                :
                $this->_router->getDefaultPlatform()
        );
        //定义常量保存控制器
        $this->_router->setController(
            isset($get_param[$this->_router->getVarController()])
                ?
                strtolower($get_param[$this->_router->getVarController()])
                :
                $this->_router->getDefaultController()
        );
        //定义常量保存操作方法
        $this->_router->setAction(
            isset($get_param[$this->_router->getVarAction()])
                ?
                strtolower($get_param[$this->_router->getVarAction()])
                :
                $this->_router->getDefaultAction()
        );
    }

    /**
     * pathinfo 模式下拼接分发参数
     */
    private function initDispatchParamByPathInfo()
    {
        //定义常量保存操作平台
        $this->_router->setPlatform(
            $this->_router->getUrl('platform') == ''
                ?
                $this->_router->getDefaultPlatform()
                :
                strtolower($this->_router->getUrl('platform'))
        );
        //定义常量保存控制器
        $this->_router->setController(
            $this->_router->getUrl('controller') == ''
                ?
                $this->_router->getDefaultController()
                :
                strtolower($this->_router->getUrl('controller'))
        );
        //定义常量保存操作方法
        $this->_router->setAction(
            $this->_router->getUrl('action') == ''
                ?
                $this->_router->getDefaultAction()
                :
                strtolower($this->_router->getUrl('action'))
        );
    }

}
