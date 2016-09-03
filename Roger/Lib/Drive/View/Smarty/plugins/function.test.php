<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/19
 * Time: 20:19
 */

// smarty_function_  是固定格式  名字和 文件名一样

// 这个用于计算面积
function smarty_function_test($params){
  $height=$params['height'];
  $width=$params['width'];

  return $height*$width;
}