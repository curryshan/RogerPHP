<?php 

namespace App\Controller;

class indexController extends XyController
{
	public function index()
	{

		$arr = array('data'=>'helloworld');
		$this->assign($arr);
		$this->display();



		// $model = M('Index');
		// var_dump($model);
		// $a = $model->get();
		// var_dump($a);

	/*	$arr = array('data'=>'shan');
		VIEW::assign($arr);
*/
		// VIEW::display('index.html');




/*		$model = new \core\lib\model();
var_dump($model);*/

/*		$data = 'hello world';
		$title = 'shanmenghao';
		$this->assign('title', $title);
		$this->assign('data', $data);
		$this->display('index.html');*/
/*
		$temp1 = \core\lib\config::get('controller', 'route');
		$temp2 = \core\lib\config::get('action', 'route');*/

		
	}
}