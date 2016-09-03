<?php 

namespace Roger\Lib;

class Route
{
	public $controller;
	public $method;

	public function __construct()
	{
		//  想要实现 /Index/index的控制器和方法的自动路由
		/**
		 *  1.隐藏index.php
		 *  2.获取url参数部分
		 *  3.返回对应控制器和方法
		 */
		if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '/') {
			$path = $_SERVER['PATH_INFO'];
			$pathArr = explode('/', trim($path, '/'));
			if (isset($pathArr[0])) {
				$this->controller = ucfirst($pathArr[0]);
			}
			if (isset($pathArr[1])) {
				$this->method = $pathArr[1];
			} else {
				$this->method = Config::get('method', 'route');;
			}
		} else {
			//  无论如何要定义一个$pathArr数组
			$pathArr = array();
			$this->controller = Config::get('controller', 'route');
			$this->method = Config::get('method', 'route');
		}
		//  为了匹配get参数的形式
		$count = count($pathArr);
		if ($count > 2) {
			$index = 2;
			while ($index < $count) {
				if (isset($pathArr[$index + 1])) {
					$_GET[$pathArr[$index]] = $pathArr[$index + 1];
				}
				$index =$index + 2; 
			} 
		}
	}
}