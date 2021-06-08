<?php
// var_dump($_GET);
// exit();

// 修正ボタンを押したら、修正するidを反映した修正画面にいく

$id = $_GET['id'];

include('functions.php'); // 関数を記述したファイルの読み込み
$pdo = connect_to_db();

$pdo = connect_to_db();
$sql = 'SELECT * FROM body_input WHERE id=:id';
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
  <form action="body_update.php" method="post">
    <fieldset>
      <!-- <legend>DB連携型todoリスト（入力画面）</legend> -->
      <a href="index.html">ホーム画面へ</a>
      <a href="body_read.php">一覧画面へ</a>
      <a href="curve_read.php">成長曲線へ</a>


      <div>
        測定日: <input type="date" name="date" value="<?= $record["date"] ?>">
      </div>
      <div>
        名前 :<input type="text" name="name" value="<?= $record["name"] ?>">
      </div>
      <div>
        誕生日 :<p name="birth">2009-04-23</p>
      </div>
      <div>
        月齢 :<input type="text" name="moon_age" value="<?= $record["moon_age"] ?>">
      </div>
      <div>
        身長 :<input type="text" name="height" value="<?= $record["height"] ?>">cm
      </div>
      <div>
        体重 :<input type="text" name="weight" value="<?= $record["weight"] ?>">kg
      </div>
      <!-- id取得のため追加 -->
      <input name="id" type="hidden" value="<?= $record['id'] ?>">
      <div>
        <button>登録</button>
      </div>
    </fieldset>
  </form>

</body>

</html>