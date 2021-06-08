<?php

// DB接続情報
function connect_to_db()
{
  $dbn = 'mysql:dbname=gsacf_l05_10;charset=utf8;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';

// DB接続
  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    exit('dbError:' . $e->getMessage());
  }
}


