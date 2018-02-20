<?php
namespace app\controllers\main;
use linkphp\boot\Controller;
class Home extends Controller
{
	public function main()
    {
        $this->test();
        $linkphp = 'linkphp框架';
        $this->assign('linkphp',$linkphp);
		$this->display();
	}
}