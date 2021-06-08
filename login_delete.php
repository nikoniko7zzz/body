<?php
// var_dump($_GET);
// exit();


// login_readで削除ボタンを押したら、idを取得して、データを削除する

$id = $_GET['id'];

include('functions.php'); // 関数を記述したファイルの読み込み
$pdo = connect_to_db();

$sql = 'DELETE FROM users_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:login_read.php");
}
