<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型ログイン（登録画面）</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <form action="login_create.php" method="POST">
    <fieldset>
      <legend>DB連携型ログイン（登録画面）</legend>
      <div>
        名前: <input type="text" name="username">
      </div>
      <div>
        パスワード: <input type="text" name="password">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

  <a href="login_read.php">ユーザー一覧</a>








  <!-- <form action="login_create.php" method="post">
    <fieldset>
      <legend>DB連携型ログインリスト（入力画面）</legend>
      <a href="login_read.php">一覧画面</a>
      <div>
        名前:<input type="text" name="username">
      </div>
      <div>
        パスワード:<input type="text" name="password">
      </div> -->
  <!-- <div>
        ユーザー or 管理者:
        <select name="is_admin">
          <option value="">選択</option>
          <option value="0">ユーザー</option>
          <option value="1">管理者</option>
        </select>
      </div> -->

  <!-- <div>
        <button>送信</button>
      </div>
    </fieldset>
  </form> -->

</body>

</html>