<?php
// データを受け取りしているか確認 POSTで送信された値は$_POSTで受け取る
// var_dump($_POST);
// exit();


 // 入力チェック(未入力の場合は弾く，commentのみ任意)
if (
  // isset ありますよね  !isset ないですよね
  !isset($_POST['date']) || $_POST['date'] == '' ||
  !isset($_POST['name']) || $_POST['name'] == '' ||
  !isset($_POST['height']) || $_POST['height'] == ''
) {
  // 「ParamError」が表示されたら，必須データが送られていないことがわかる
  exit('ParamError');
}

// inputのデータを変数に格納
$date = $_POST['date'];
$name = $_POST['name'];
$height = $_POST['height'];

// ここから↓ read.phpも同じ＊＊＊＊＊＊＊＊＊＊------------------------------------
// DB接続情報 dbname以外は固定
// 「dbname」「port」「host」「username」「password」を設定
$dbn = 'mysql:dbname=gsacf_l05_10;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';
// $user = 'root'; と $pwd = ''; は初期値 デプロイするときだけ変更が必要


// DB接続 固定
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  // 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる.
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
// ここまで↑＊＊＊＊＊＊＊＊＊＊---------------------------------------------------

// SQL作成 & 実行
$sql = 'INSERT INTO body(id, date, name, height) VALUES(NULL, :date, :name, :height)';

// 変数をバインド変数(:date)に格納!!
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':height', $height, PDO::PARAM_STR);
$status = $stmt->execute();

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
