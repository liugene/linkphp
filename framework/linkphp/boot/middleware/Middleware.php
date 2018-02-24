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
                $this->beginMiddleware = $handle;
                break;
            case 'appMiddleware':
                $this->appMiddleware = $handle;
                break;
            case 'modelMiddleware':
                $this->modelMiddleware = $handle;
                break;
            case 'controllerMiddleware':
                $this->controllerMiddleware = $handle;
                break;
            case 'actionMiddleware':
                $this->actionMiddleware = $handle;
                break;
            case 'destructMiddleware':
                $this->destructMiddleware = $handle;
                break;
        }
    }

    private function isValidate($middle)
    {
        return in_array($middle,$this->validateMiddle);
    }

    public function begin()
    {
        call_user_func(array_reduce($this->beginMiddleware,$this->exec()));die;
    }

    public function app(){}

    public function model(){}

    public function controller(){}

    public function action(){}

    public function destruct(){}

    public function exec()
    {
        return function($v1,$v2){
            return function() use ($v1,$v2) {
                return (new $v2)->handle($v1);
            };
        };
    }

}
