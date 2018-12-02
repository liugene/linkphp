<?php
namespace app\http\controller;

use framework\Controller;
use app\http\model\Home as HomeModel;

class Home extends Controller
{
    public function main()
    {
        $model = new HomeModel();
        dump($model->select());die;
        return ['code' => 200, 'msg' => 'linkphp 创建成功!'];
    }

}