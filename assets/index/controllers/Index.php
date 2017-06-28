<?php
namespace assets\index\controllers;
use bootstrap\Controller;
class Index extends Controller
{
	public function index()
    {
        $linkphp = 'test';
        $this->assign('linkphp',$linkphp);
		$this->display();
		$model = new \assets\index\models\Index;
        $model = new \assets\common\models\Common;
        \assets\common\controllers\Common::test();
        //$model = new \assets\index\controllers\domore\Index;
		dump($model);
	}
}