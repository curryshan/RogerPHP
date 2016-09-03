<?php

// 输出变量或数组 类似print_r的功能
function p($var)
{
	if (is_null($var)) {
		echo 'is null';
		exit;
	}
	var_dump($var);
	exit;
}

function C($controller, $method)
{
	$controllerFile = APP.'/Controller/'.$controller.'Controller.class.php';
	$controllerClass = '\\'.MODULE.'\Controller\\'.$controller.'Controller';
	if (is_file($controllerFile)) {
		$controller = new $controllerClass();
		$controller->$method();
	} else {
		throw new \Exception('找不到控制器', $controllerClass);
	}
}

function M($model)
{
  /*require_once(APP_NAME.'/Lib/Model/'.$model.'Model.class.php');
  $className=$model.'Model';
  $model=new $className();
  return $model;*/

  $modelFile = APP.'/Model/'.$model.'Model.class.php';
  $modelClass = '\\'.MODULE.'\Model\\'.$model.'Model';
  if (is_file($modelFile)) {
  	$model = new $modelClass();
  	return $model;
  } else {
  	throw new \Exception('找不到模型', $modelClass);
  }
}