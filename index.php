<?php 

/**
 *   入口文件
 *   1. 定义常量
 *   2. 加载函数库
 *   3. 启动框架
 *   好久不用怕忘了
 */

date_default_timezone_set('PRC');

define('BASE', realpath('./'));
define('ROGER', BASE.'/Roger');
define('APP', BASE.'/App');
define('MODULE', 'App');

define('DEBUG',true);

if (DEBUG) {
	ini_set('display_errors', 'On');
} else {
	ini_set('display_errors', 'Off');
}

include ROGER.'/Common/function.php';

include ROGER.'/Roger.class.php';

spl_autoload_register('\Roger\Roger::load');

\Roger\Roger::run();

