<?php

namespace Roger\Lib;

class DB
{
	public static $db;

	public static function init($typeName, $config)
	{
		$className = '\Roger\Lib\Drive\Database\\'.$typeName;
		self::$db = $className::getInstance();
		self::$db->connect($config);
	}

	public static function query($table, $where = '', $fileds='*')
	{
		return self::$db->query($table, $where1 = $where, $fileds1=$fileds);
	}

	public static function findOne()
	{
		return self::$db->findOne();
	}

	public static function findAll()
	{
		return self::$db->findAll();
	}

	public static function insert($table, Array $data,$type=true)
	{
		return self::$db->insert($table, $data,$type=$type);
	}

	public static function delete($table,Array $where)
	{
		return self::$db->delete($table,$where);
	}

	public static function update($table,Array $data, Array $where)
	{
		return self::$db->update($table,$data,$where);
	}

	public static function my_query($sql)
	{
		return self::$db->my_query($sql);  
	}

	public static function getResCount()
	{
		return self::$db->getResCount();
	}
	
}