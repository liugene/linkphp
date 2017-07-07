<?php
namespace assets\main\controllers;
use linkphp\bootstrap\Controller;
class Home extends Controller
{
	public function main()
    {
        $linkphp = 'linkphp框架';
        $this->assign('linkphp',$linkphp);
		$this->display();
		$model = new \assets\main\models\Index;
        $model = new \assets\base\models\Common;
        \assets\base\controllers\Common::test();
        //$model = new \assets\main\controllers\domore\Index;
		dump($model);
	}
}