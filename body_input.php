<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型・身体測定リスト（入力画面）</title>
  <link rel="stylesheet" href="style.css">
</head>

<!-- action method nameを入れないとPHPは動かない -->

<body>
  <form action="body_create.php" method="post">
    <fieldset>
      <!-- <legend>DB連携型todoリスト（入力画面）</legend> -->
      <a href="index.html">ホーム画面へ</a>
      <a href="body_read.php">一覧画面へ</a>
      <a href="curve_read.php">成長曲線へ</a>
      <div>
        測定日: <input type="date" name="date">
      </div>
      <div>
        名前 :<input type="text" name="name">
      </div>
      <div>
        誕生日 :<p name="birth">2009-04-23</p>
      </div>
      <div>
        月齢 :<input type="text" name="moon_age">
      </div>
      <div>
        身長 :<input type="text" name="height">cm
      </div>
      <div>
        体重 :<input type="text" name="weight">kg
      </div>
      <div>
        <button>送信</button>
      </div>
    </fieldset>
  </form>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
  </script>


</body>

</html>