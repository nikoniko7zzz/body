<?php
// データを受け取りしているか確認 POSTで送信された値は$_POSTで受け取る
// var_dump($_POST);
// exit();


 // 入力チェック(未入力の場合は弾く，commentのみ任意)
if (
  // isset ありますよね  !isset ないですよね
  !isset($_POST['date']) || $_POST['date'] == '' ||
  !isset($_POST['name']) || $_POST['name'] == '' ||
  // !isset($_POST['birth']) || $_POST['birth'] == '' ||
  !isset($_POST['moon_age']) || $_POST['moon_age'] == '' ||
  !isset($_POST['height']) || $_POST['height'] == '' ||
  !isset($_POST['weight']) || $_POST['weight'] == ''
) {
  // 「ParamError」が表示されたら，必須データが送られていないことがわかる
  exit('ParamError');
}

// inputのデータを変数に格納
$date = $_POST['date'];
$name = $_POST['name'];
// $birth = $_POST['birth'];
$moon_age = $_POST['moon_age'];
$height = $_POST['height'];
$weight = $_POST['weight'];

// DBに接続する関数を定義
include('functions.php'); // 関数を記述したファイルの読み込み
$pdo = connect_to_db();  // 関数実行

// SQL作成 & 実行
$sql = 'INSERT INTO body_input(id, date, name, moon_age, height, weight, 	created_at, updated_at) VALUES(NULL, :date, :name, :moon_age, :height, :weight, sysdate(), sysdate())';
// 変数をバインド変数(:date)に格納!!

// バインド変数についての設定 ハッキングを防ぐ
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':moon_age', $moon_age, PDO::PARAM_STR);
$stmt->bindValue(':height', $height, PDO::PARAM_STR);
$stmt->bindValue(':weight', $weight, PDO::PARAM_STR);
$status = $stmt->execute(); //これでsqlを実行

// 失敗時にエラーを出力し，成功時は登録画面に戻る
if ($status==false) {
  $error = $stmt->errorInfo();
  // データ登録失敗次にエラーを表示
  exit('sqlError:'.$error[2]);
} else {
  // 登録ページへ移動
  header('Location:body_input.php');
}

?>
