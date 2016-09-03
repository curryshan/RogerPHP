<?php 

namespace Roger\Lib\Drive\Log;
use Roger\Lib\Config;

//  文件日志类
class file
{
	public $path; //日志存储位置

	public function  __construct()
	{
		//  文件目录 写到配置文件
		$this->path = config::get('option', 'log');
	}
	public function log($message, $file='log')
	{
		/**
		 * 1 确定文件存储位置是否存在（新建目录）
		 * 2 写入日志
		 */
		if (!is_dir($this->path['path'].date('YmdH'))) {

			mkdir($this->path['path'].date('YmdH'), 0777, true);
			chmod($this->path['path'].date('YmdH'), 0777);
		} 

		//  加了date()这样 每个小时生成一个日志文件
		$filename = $this->path['path'].date('YmdH').'/'.$file.'.php';
		$data = date('Y-m-d H:i:s').json_encode($message).PHP_EOL;
		return file_put_contents($filename, $data, FILE_APPEND);
	}
}