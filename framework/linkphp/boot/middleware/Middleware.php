<?php

// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liugene <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               配置类
// +----------------------------------------------------------------------

namespace linkphp\boot\middleware;

use linkphp\boot\Exception;
use Closure;

class Middleware
{

    protected $beginMiddleware = [];

    protected $appMiddleware = [];

    protected $modelMiddleware = [];

    protected $controllerMiddleware = [];

    protected $actionMiddleware = [];

    protected $destructMiddleware = [];

    private $validateMiddle = [
        'beginMiddleware',
        'appMiddleware',
        'modelMiddleware',
        'controllerMiddleware',
        'actionMiddleware',
        'destructMiddleware'
    ];

    public function import($middle)
    {
        if(is_array($middle)){
            foreach($middle as $tag => $handle){
                if($this->isValidate($tag)){
                    $this->add($tag,$handle);
                } else {
                    throw new Exception('不是合法的中间件');
                }
            }
        }
    }

    public function add($tag,$handle)
    {
        switch($tag){
            case 'beginMiddleware':
                if($handle instanceof Closure){
                    $handleClosure[] = $handle;
                    $this->beginMiddleware = array_merge($this->beginMiddleware,$handleClosure);
                    break;
                }
                $this->beginMiddleware = array_merge($this->beginMiddleware,$handle);
                break;
            case 'appMiddleware':
                $this->appMiddleware[] = $handle;
                break;
            case 'modelMiddleware':
                $this->modelMiddleware[] = $handle;
                break;
            case 'controllerMiddleware':
                $this->controllerMiddleware[] = $handle;
                break;
            case 'actionMiddleware':
                $this->actionMiddleware[] = $handle;
                break;
            case 'destructMiddleware':
                $this->destructMiddleware[] = $handle;
                break;
        }
    }

    public function isValidate($middle)
    {
        return in_array($middle,$this->validateMiddle);
    }

    public function beginMiddleware($middle=null)
    {
        if(!is_null($middle)){
            $this->add('beginMiddleware',$middle);
            return;
        }
        return call_user_func(array_reduce($this->beginMiddleware,$this->exec()));
}

    public function appMiddleware(){}

    public function modelMiddleware(){}

    public function controllerMiddleware(){}

    public function actionMiddleware(){}

    public function destructMiddleware(){}

    public function exec()
    {
        return function($v1,$v2){
            if($v2 instanceof Closure){
                return call_user_func($v2,$v1);
            }
            return function() use ($v1,$v2) {
                return call_user_func([new $v2,'handle'],function () {
                });
            };
        };
    }

}
