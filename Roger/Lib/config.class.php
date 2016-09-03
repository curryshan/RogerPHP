<?php 

namespace Roger\Lib;

class Config
{
	static public $conf = array();
	static public function get($name, $file)
	{
		if (isset(self::$conf[$file])) {
			return self::$conf[$file][$name];
		} else {
			$filePath = ROGER.'/Config/'.$file.'.php';
			if (is_file($filePath)) {
				$conf = include $filePath;
				if (isset($conf[$name])) {
					self::$conf[$file] = $conf;
					return $conf[$name];
				} else {
					throw new \Exception('没有这个配置项', $name);
				}
			} else {
				throw new \Exception('没有找到配置文件', $file);
			}			
		}
	}

	static public function all($file)
	{

			if (isset(self::$conf[$file])) {
				return self::$conf[$file];
			} else {
				$filePath = ROGER.'/Config/'.$file.'.php';
				$conf = include $filePath;
				if (is_file($filePath)) {
					self::$conf[$file] = $conf;
					return $conf;
				} else {
					throw new \Exception('没有找到配置文件', $file);
				}			
			}
		}
	}

