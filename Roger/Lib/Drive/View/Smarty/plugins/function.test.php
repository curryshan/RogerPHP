<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/19
 * Time: 20:19
 */

// smarty_function_  �ǹ̶���ʽ  ���ֺ� �ļ���һ��

// ������ڼ������
function smarty_function_test($params){
  $height=$params['height'];
  $width=$params['width'];

  return $height*$width;
}