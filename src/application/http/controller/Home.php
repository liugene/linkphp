<?php
namespace app\http\controller;

use framework\Controller;
use linkphp\http\HttpRequest;

class Home extends Controller
{
    public function main()
    {
        return ['code' => 200, 'msg' => 'linkphp 创建成功!'];
    }

}