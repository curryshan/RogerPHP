<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/19
 * Time: 20:44
 */

function smarty_block_test2 ($params,$content){
  $substr=$params['substr'];
  if($substr==true){
    return substr($content,0,7);
  }
}