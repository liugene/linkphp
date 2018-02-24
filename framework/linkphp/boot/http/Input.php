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

namespace linkphp\boot\http;

use Closure;

class Input
{

    private $filter;

    public function get($key='',$filter)
    {
        return $key=='' ? $this->param($_GET,$filter) : $this->param($_GET[$key],$filter);
    }

    public function post($key='',$filter)
    {
        return $key=='' ? $this->param($_POST,$filter) : $this->param($_POST[$key],$filter);
    }

    public function server($key='')
    {
        return $key=='' ? $_SERVER : $_SERVER[$key];
    }

    public function file($key='')
    {
        return $key=='' ? $_FILES : $_FILES[$key];
    }

    public function cookie($key='')
    {
        return $key=='' ? $_COOKIE : $_COOKIE[$key];
    }

    public function env($key='')
    {
        return $key=='' ? $_ENV : $_ENV[$key];
    }

    public function getInput($filter)
    {
        return $this->param(file_get_contents('php://input'),$filter);
    }

    public function param($data,$filters)
    {
        $filter = $this->getFilter($filters);
        if (is_array($data)) {
            array_walk_recursive($data, [$this, 'filterValue'], $filter);
            reset($data);
        } else {
            $this->filterValue($data,'',$filter);
        }
        return $data;
    }

    private function getFilter($filter)
    {
        $filter = $filter ?: $this->filter();
        if (is_string($filter) && false === strpos($filter, '/')) {
            $filter = explode(',', $filter);
        } else {
            $filter = (array) $filter;
        }
        return $filter;
    }

    public function filter($filter=null)
    {
        if (is_null($filter)) {
            return $this->filter;
        } else {
            $this->filter = $filter;
        }
    }

    public function filterValue(&$value,$key,$filters)
    {
        foreach($filters as $filter){
            if($filter instanceof Closure){
                // 调用函数或者方法过滤
                $value = call_user_func($filter, $value);
            }
        }
        return $this->filterExp($value);
    }

    /**
     * 过滤表单中的表达式
     * @param string $value
     * @return void
     */
    public function filterExp(&$value)
    {
        $value = trim($value);
        // 过滤查询特殊字符
        if (is_string($value)) {
            $value = preg_replace('/^EXP|NEQ|GT|EGT|LT|ELT|OR|XOR|LIKE|NOTLIKE|NOT LIKE|NOT BETWEEN|NOTBETWEEN|BETWEEN|NOTIN|NOT IN|IN$/i','', $value);
            $value = trim($value);
        }
        // TODO 其他安全过滤
    }

}
