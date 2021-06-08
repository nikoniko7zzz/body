<?php

// 新規ユーザー登録--------------

// var_dump($_POST);
// exit();


if (
!isset($_POST['username']) || $_POST['username'] == '' ||
!isset($_POST['password']) || $_POST['password'] == ''
// !isset($_POST['is_admin']) || $_POST['is_admin'] == ''
) {
  exit('ParamError');
}

$username = $_POST['username'];
$password = $_POST['password'];
// $is_admin = $_POST['is_admin'];

// DBに接続する関数を定義
include('functions.php'); // 関数を記述したファイルの読み込み
$pdo = connect_to_db();  // 関数実行

// SQL作成 & 実行
$sql = 'INSERT INTO users_table(id, username, password, is_admin, is_deleted, created_at, updated_at) VALUES(NULL, :username, :password, 1, 1, sysdate(), sysdate())';
// 変数をバインド変数(:date)に格納!!


// バインド変数についての設定 ハッキングを防ぐ
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute(); //これでsqlを実行


// 失敗時にエラーを出力し，成功時は登録画面に戻る
if ($status == false) {
  $error = $stmt->errorInfo();
  // データ登録失敗次にエラーを表示
  exit('sqlError:' . $error[2]);
} else {
  // 一覧ページへ移動
  header('Location:login_read.php');
}


?>