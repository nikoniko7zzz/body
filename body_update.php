<?php



// データを受け取りしているか確認 POSTで送信された値は$_POSTで受け取る
// var_dump($_POST);
// exit();


// 入力チェック(未入力の場合は弾く，commentのみ任意)
if (
  // isset ありますよね  !isset ないですよね
  !isset($_POST['date']) || $_POST['date'] == '' ||
  !isset($_POST['name']) || $_POST['name'] == '' ||
  !isset($_POST['moon_age']) || $_POST['moon_age'] == '' ||
  !isset($_POST['height']) || $_POST['height'] == '' ||
  !isset($_POST['weight']) || $_POST['weight'] == '' ||
  !isset($_POST['id']) || $_POST['id'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}


// inputのデータを変数に格納
$date = $_POST['date'];
$name = $_POST['name'];
$moon_age = $_POST['moon_age'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$id = $_POST['id'];


// DBに接続する関数を定義
include('functions.php'); // 関数を記述したファイルの読み込み
$pdo = connect_to_db();

// SQL修正
$sql = "UPDATE body_input SET date=:date, name=:name, moon_age=:moon_age, height=:height, weight=:weight,updated_at=sysdate() WHERE id=:id";

// バインド変数についての設定 ハッキングを防ぐ
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':moon_age', $moon_age, PDO::PARAM_STR);
$stmt->bindValue(':height', $height, PDO::PARAM_STR);
$stmt->bindValue(':weight', $weight, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute(); //これでsqlを実行

if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常に実行された場合は一覧ページファイルに移動し，処理を実行する header("Location:todo_read.php");
  header("Location:body_read.php");
  exit();
}

?>
