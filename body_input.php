<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（入力画面）</title>
</head>

<!-- action method nameを入れないとPHPは動かない -->

<body>
  <form action="body_create.php" method="post">
    <fieldset>
      <!-- <legend>DB連携型todoリスト（入力画面）</legend> -->
      <a href="body_read.php">一覧画面</a>
      <div>
        測定日: <input type="date" name="date">
      </div>
      <div>
        名前: <input type="text" name="name">
      </div>
      <div>
        身長: <input type="text" name="height">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>