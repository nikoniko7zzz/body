<?php


// ＊＊＊＊＊＊＊＊＊＊ ↓create.phpと同じ
// DB接続情報
$dbn = 'mysql:dbname=gsacf_l05_10;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
// ＊＊＊＊＊＊＊＊＊＊ ↑create.phpと同じ


//  データ参照SQL作成
$sql = 'SELECT * FROM body'; //全部表示
// $sql = 'SELECT * FROM todo_table ORDER BY deadline ASC LIMIT 5'; //上から5個表示

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
// $statusにSQLの実行結果が入る(取得したデータではない点に注意)


//  データを表示しやすいようにまとめる
if ($status==false) {
  $error = $stmt->errorInfo();
  exit('sqlError:'.$error[2]);
// 失敗時 エラー出力
 } else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll()で全部取れる! あとは配列の処理!!
  $output = "";
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["date"]}</td>";
    $output .= "<td>{$record["name"]}</td>";
    $output .= "<td>{$record["height"]}</td>";
    $output .= "</tr>";
  }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>DB連携型todoリスト（一覧画面）</legend>
    <a href="body_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>deadline</th>
          <th>todo</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>