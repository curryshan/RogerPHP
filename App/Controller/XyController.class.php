<?php 

namespace App\Controller;

class XyController
{
	protected  $controller;
	protected  $method;
	protected  $tpl;

	public function __construct()
	{
		// 路由类找到当前控制器和方法
		$route = new \Roger\Lib\Route();

		$this->controller = $route->controller;
		$this->method = $route->method;
	}

	protected function display($tpl = '')
	{
		if ($this->checkTpl($tpl)) {
			\Roger\Lib\VIEW::display($this->tpl);
		}
	}
	//  等待优化
	protected function checkTpl($tpl)
	{
		if (empty($tpl)) {
			$this->tpl = $this->controller.'/'.$this->method.'.html';
			return true;
		} elseif (strpos(trim($tpl, '/'), '/')) {
			$tplPathDir = explode('/', $tpl);
			if (count($tplPathDir) == 2) {
				$tplPathDir[0] = ucfirst($tplPathDir[0]);
				$tmpTplPath = APP.'/View/'.$tplPathDir[0].'/'.$tplPathDir[1].'.html';
				if (is_file($tmpTplPath)) {
					$this->tpl = $tplPathDir[0].'/'.$tplPathDir[1].'.html';
					return true;
				} else {
					throw new \Exception ('模板'.$tmpTplPath.'不存在');
				}
			}
		} else {
			$tmpTplPath = APP.'/View/'.$this->controller.'/'.$tpl.'.html';
			if (is_file($tmpTplPath)) {
				$this->tpl = $this->controller.'/'.$tpl.'.html';
				return true;
			} else {
				throw new \Exception ('模板'.$tmpTplPath.'不存在');
			}
		}
	}

	protected function assign($data)
	{
		\Roger\Lib\VIEW::assign($data);
	}

	protected function my_assign($name, $data)
	{
		\Roger\Lib\VIEW::my_assign($name, $data);
	}
}