<?PHP

// DBに接続する関数を定義
include('functions.php'); // 関数を記述したファイルの読み込み
$pdo = connect_to_db();  // 関数実行


//  データ参照SQL作成 SELECT=参照 *=全部
$sql = 'SELECT * FROM users_table'; //全部表示
// $sql = 'SELECT * FROM todo_table ORDER BY deadline ASC LIMIT 5'; //上から5個表示

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
// $statusにSQLの実行結果が入る(取得したデータではない点に注意)


//  データを表示しやすいようにまとめる
if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
  // 失敗時 エラー出力
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll()で全部配列で取れる! あとは配列の処理!!
  $output = "";
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["id"]}</td>";
    $output .= "<td>{$record["username"]}</td>";
    $output .= "<td>{$record["password"]}</td>";
    $output .= "<td>{$record["is_admin"]}</td>";
    $output .= "<td>{$record["is_deleted"]}</td>";
    $output .= "<td>{$record["created_at"]}</td>";
    $output .= "<td>{$record["updated_at"]}</td>";
    // edit deleteリンクを追加
    $output .= "<td><a href='login_edit.php?id={$record["id"]}'>修正</a></td>";
    $output .= "<td><a href='login_delete.php?id={$record["id"]}'>削除</a></td>";
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
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <fieldset>
    <legend>DB連携型ユーザーリスト（一覧画面）</legend>
    <a href="index.html">ホーム画面へ</a>
    <a href="login_input.php">ユーザー登録画面へ</a>
    <table>
      <thead>
        <tr>
          <th>id</th>
          <th>username</th>
          <th>password</th>
          <th>is_admin</th>
          <th>is_deleted</th>
          <th>created_at</th>
          <th>updated_at</th>
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