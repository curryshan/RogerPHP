<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/19
 * Time: 20:35
 */

// 格式比较自然了

// 这个函数用于时间格式化

function smarty_modifier_test($utime,$format){

  return date($format,$utime);

}