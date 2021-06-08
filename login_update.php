<?php
// var_dump($_POST);
// exit();


if (
  !isset($_POST['username']) || $_POST['username'] == '' ||
  !isset($_POST['password']) || $_POST['password'] == '' ||
  !isset($_POST['id']) || $_POST['id'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}


$todo = $_POST['username'];
$deadline = $_POST['password'];
$id = $_POST['id'];


include('functions.php'); // 関数を記述したファイルの読み込み
$pdo = connect_to_db();


$sql = "UPDATE users_table SET username=:username, password=:password, updated_at=sysdate() WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $todo, PDO::PARAM_STR);
$stmt->bindValue(':password', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常に実行された場合は一覧ページファイルに移動し，処理を実行する header("Location:todo_read.php");
  header("Location:login_read.php");
  exit();
}
