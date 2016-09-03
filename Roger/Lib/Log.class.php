<?php 

namespace Roger\Lib;

class Log
{
	static public $class;
	
	static public function init() 
	{
		//  确定存储方式
		$drive = \Roger\Lib\Config::get('drive', 'log');
		$class =  '\Roger\Lib\Drive\Log\\'.$drive;
		self::$class = new $class();
	}


	static public function log($name, $log = 'Log')
	{
		self::init();
		self::$class->log($name, $log);//调用驱动里面的方法
	}
}