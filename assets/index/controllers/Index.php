<?php
namespace app\index\controllers;
use link\Controller;
class Index extends Controller
{
	public function index()
    {
        $linkphp = 'test';
        $this->assign('linkphp',$linkphp);
		$this->display();
		$model = new \app\index\models\Index;
        $model = new \app\common\models\Common;
        \app\common\controllers\Common::test();
        //$model = new \app\index\controllers\domore\Index;
		dump($model);
	}
}