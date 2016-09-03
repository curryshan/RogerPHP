<?php 

namespace Roger;

class Roger
{
	private static $config = array();

	static public function run()
	{
		$route = new \Roger\Lib\Route();
		$controller = $route->controller;
		$method = $route->method;
		self::dbInit();
		self::viewInit();
		C($controller, $method);
		\Roger\Lib\Log::log('controller:'.$controller.'  method:'.$method); 
	}

	static public function load($class)
	{
		// 自动加载类库
		if (isset(self::$classMap['$class'])) {
			return true;
		} else {
			$classNew = str_replace('\\', '/', $class);
			$file = BASE.'/'.$classNew.'.class.php';
			if (is_file($file)) {
				include $file;
				self::$classMap[$class] = $classNew;
			} else {
				return false;
			}
		}
	}

	static private function dbInit() 
	{	
		if (!isset(self::$config['database'])) {
			self::$config['database'] = \Roger\Lib\Config::all('database');
		}
		\Roger\Lib\DB::init('Pdo', self::$config['database']);
	}

	static private function viewInit()
	{
		if (!isset(self::$config['view'])) {
			self::$config['view'] = \Roger\Lib\Config::all('view');
		}
		\Roger\Lib\VIEW::init('Smarty', self::$config['view']);
	}
}