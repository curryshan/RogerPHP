<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/19
 * Time: 20:35
 */

// ��ʽ�Ƚ���Ȼ��

// �����������ʱ���ʽ��

function smarty_modifier_test($utime,$format){

  return date($format,$utime);

}