<?php

namespace app\http\controller;

use framework\Controller;

class Home extends Controller
{

    protected $returnType = [
        'main' => 'json'
    ];

    public function main()
    {
        $model = model('app/http/model/Home');
        return ['code' => 200, 'msg' => $model->select()->toArray()];
    }

    public function index()
    {
        return $this->display('http/home/main');
    }

}