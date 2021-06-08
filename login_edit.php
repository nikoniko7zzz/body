<?php
// var_dump($_GET);
// exit();

// 修正ボタンを押したら、修正するidを反映した修正画面にいく

$id = $_GET['id'];

include('functions.php'); // 関数を記述したファイルの読み込み
$pdo = connect_to_db();

$pdo = connect_to_db();
$sql = 'SELECT * FROM users_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}


?>




<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <form action="login_update.php" method="POST">
    <fieldset>
      <legend>DB連携型ログイン（修正画面）</legend>
      <div>
        名前: <input type="text" name="username" value="<?= $record["username"] ?>">
      </div>
      <div>
        パスワード: <input type="text" name="password" value="<?= $record["password"] ?>">
      </div>
      </div>
      <!-- id取得のため追加 -->
      <input name="id" type="hidden" value="<?= $record['id'] ?>">
      <div>
        <div>
          <button>登録</button>
        </div>
    </fieldset>
  </form>

  <a href="login_read.php">ユーザー一覧</a>

</html>