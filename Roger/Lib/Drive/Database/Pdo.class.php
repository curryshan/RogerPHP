<?php

namespace Roger\Lib\Drive\Database;
/*
 * 封装一些自己常用的数据库操作
 *
 */

class Pdo 
{
  private static $_dbSource;
  private static $_instance;
  private static $_stmt;

  private function __construct()
  {

  }

  public static function getInstance()
  {
    if (!(self::$_instance instanceof self)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  public function connect($config)
  {
    //  传参方式换
    extract($config);
    if (!self::$_dbSource) {
      try {
        self::$_dbSource = new \pdo(
          "mysql:host=" . $host . ";dbname=" . $dbname,
          $username, $password, array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ));
        self::$_dbSource->query('set names utf8');
      } catch ( \PDOException $e) {
        //   封装这个错误类
        echo $e->getMessage();
      }
      return self::$_instance;
    }
  }

  public function query($table, $where, $fileds = '*')
  {
    if (is_array($fileds) && !empty($fileds)) {
      $fileds = implode(',', $fileds);
    }
    if (is_array($where) && !empty($where)) {
      foreach ($where as $key => $val) {
        $keys[] = $key;
        $vals[] = $val;
        $whereSql[] = "`" . $key . "`=:" . $key;
        $stmtKey = ':' . $key;
        $stmtArray[$stmtKey] = $val;
      }
      $where = implode(' and ', $whereSql);
      $sql = 'select ' . $fileds . ' from ' . $table . ' where ' . $where;
      self::$_stmt = self::$_dbSource->prepare($sql);
      self::$_stmt->execute($stmtArray);
    } elseif ($where == '') {
      $sql = 'select ' . $fileds . ' from ' . $table;
      self::$_stmt = self::$_dbSource->prepare($sql);
      self::$_stmt->execute();
    } else {
      echo '查询错误！';
    }
    return self::$_instance;
  }

  public function findOne()
  {
    $row = array();
    if (self::$_stmt->rowCount()) {
      $row = self::$_stmt->fetch(\PDO::FETCH_ASSOC);
    }
    return $row;
  }


  public function findAll()
  {
    $rows = array();
    if (self::$_stmt->rowCount()) {
      $rows = self::$_stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    return $rows;
  }

  public function insert($table, $data, $insertType= true)
  {
   if ($insertType) {
    $type = 1;
  } else {
    $type = 0;
  }
  $sign = 0;
  if (!empty($data)) {
    foreach ($data as $key => $val) {
      $keys[] = $key;
      $vals[] = $val;
    }
    $valsSql = implode("','", $vals);
    if ($type) {
      $sql = "insert into " . $table . " values ('','" . $valsSql . "')";
    } else {
      $keysSql = implode(',', $keys);
      $sql = "insert into " . $table . " (" . $keysSql . ") values ('" . $valsSql . "')";
    }
    $sign = self::$_dbSource->exec($sql);
  }
  return $sign;
}


public function delete($table, Array $where)
{
  $sign = 0;
  if (!empty($where)) {
    foreach ($where as $key => $val) {
      $keySql = $key;
      $valSql = $val;
    }
    $sql = "delete from " . $table . " where " . $keySql . "=" . $valSql;
    $sign = self::$_dbSource->exec($sql);
  }
  return $sign;
}

  //  这个$data的值会自动加上单引号 对于int类型的数据有风险
public function update($table, Array $data, Array $where)
{
  $sign = 0;
  if (!empty($where) && !empty($data)) {
    foreach ($data as $key => $val) {
      $dataKey = $key;
      $dataVal = $val;
      $dataSql[] = "`" . $key . "`='" . $val . "'";
    }
    foreach ($where as $key => $val) {
      $whereKey = $key;
      $whereVal = $val;
    }
    $dataSqls = implode(',', $dataSql);
    $sql = "update " . $table . " set " . $dataSqls . " where " . $whereKey . "='" . $whereVal."'";
    $sign = self::$_dbSource->exec($sql);
  }
  return $sign;
}

public function my_query($sql)
{
  self::$_stmt = self::$_dbSource->query($sql);
  return self::$_instance;
}

  //  对于select 语句 执行效果不敢保证
public function getResCount()
{
  return self::$_stmt->rowCount();
}

}





