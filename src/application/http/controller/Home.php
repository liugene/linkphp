<?php
namespace app\http\controller;

use framework\Controller;
use app\http\model\Home as HomeModel;

class Home extends Controller
{
    public function main()
    {
        $model = new HomeModel();
        return ['code' => 200, 'msg' => $model->find()->toArray()];
    }

}