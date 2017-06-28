<?php
namespace app\index\controllers;
use Link\Controller;
class Index extends Controller
{
	public function index()
    {
		$model = new \app\index\models\Index;
        $model = new \app\common\models\Common;
        \app\common\controllers\Common::test();
        $model = new \app\index\controllers\domore\Index;
		dump($model);
	}
}