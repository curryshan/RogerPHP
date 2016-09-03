<?php

namespace Roger\Lib;


class VIEW 
{
	public static  $view;

	public static function init($typeName,$conf)
    {
        // smarty没有命名空间 所以手动包含
        include ROGER.'/Lib/Drive/View/Smarty/Smarty.class.php';
        self::$view = new $typeName;
        foreach ($conf as $key=>$val) {
        	self::$view->$key = $val;
        }
    }

    public static function assign($data)
    {
    	foreach ($data as $key=>$val) {
            self::$view->assign($key,$val);
        }
    }
    
    public static function my_assign($name, $data) 
    {
      self::$view->assign($name,$data);
  }


  public static function display($tpl) 
  {
      self::$view->display(APP.'/View/'.$tpl);
  }

}
