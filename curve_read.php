<?php

// DBに接続する関数を定義
include('functions.php'); // 関数を記述したファイルの読み込み
$pdo = connect_to_db();  // 関数実行

// 標準データheight_standardの参照と配列化---------------------
//  データ参照SQL作成 SELECT=参照 *=全部
$sql_height_standard = 'SELECT * FROM height_standard'; //全部表示

$stmt = $pdo->prepare($sql_height_standard);
$status = $stmt->execute();
// $statusにSQL_height_standardの実行結果が入る(取得したデータではない点に注意)

//  データを配列にまとめる
if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sql_height_standardError:' . $error[2]);
  // 失敗時 エラー出力
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll()で全部配列で取れる! あとは配列の処理!!
  //JSON形式のフォーマットに変換し
  $json_array_height_standard = json_encode($result);
}
// -------------------------------------------------------

// 個人入力データbody_inputの参照と配列化---------------------
//  データ参照SQL作成 SELECT=参照 *=全部
$sql_body_input = 'SELECT * FROM body_input'; //全部表示

$stmt = $pdo->prepare($sql_body_input);
$status = $stmt->execute();
// $statusにSQL_body_inputの実行結果が入る(取得したデータではない点に注意)

//  データを配列にまとめる
if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sql_body_inputError:' . $error[2]);
  // 失敗時 エラー出力
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll()で全部配列で取れる! あとは配列の処理!!
  //JSON形式のフォーマットに変換し
  $json_array_body_input = json_encode($result);
}
// -------------------------------------------------------
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型リスト（一覧画面）</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>

  <a href="index.html">ホーム画面へ</a>
  <a href="body_input.php">入力画面へ</a>
  <a href="body_read.php">一覧画面へ</a>

  <p>表示したい期間を選択</p>
  <select id="curve_form">
    <option value="">---</option>
    <option value="13">0〜1歳</option>
    <option value="25">0〜2歳</option>
    <option value="37">0〜3歳</option>
    <option value="49">0〜4歳</option>
    <option value="61">0〜5歳</option>
    <option value="73">0〜6歳</option>
    <option value="85">0〜7歳</option>
  </select>
  <input type="button" value="表示する" onclick="clickBtn()" />






  <div style=" margin: 0 100px;">
    <canvas id="myLineChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
  </div>


  <!-- <script src="js/jquery-3.5.1.min.js"></script> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

  <script>
    // // windowを開いたら
    // window.addEventListener('DOMContentLoaded', function() {

    //   // 標準データheight_standard---------------------
    //   // phpからjsonデータを持ってくる
    //   const height_standard_array = JSON.parse('<?php echo $json_array_height_standard; ?>');
    //   // 連想配列を列ごとに配列にする
    //   const 月齢_array = height_standard_array.map(item => item.月齢)
    //   const 標準負2SD_array = height_standard_array.map(item => item.標準負2SD)
    //   const 標準負1SD_array = height_standard_array.map(item => item.標準負1SD)
    //   const 標準_array = height_standard_array.map(item => item.標準)
    //   const 標準正1SD_array = height_standard_array.map(item => item.標準正1SD)
    //   const 標準正2SD_array = height_standard_array.map(item => item.標準正2SD)

    //   // 個人入力データbody_input---------------------
    //   // phpからjsonデータを持ってくる
    //   const body_input_array = JSON.parse('<?php echo $json_array_body_input; ?>');
    //   // 連想配列を列ごとに配列にする
    //   const height_array = body_input_array.map(item => item.height)
    // });

    function clickBtn() {
      const str = document.getElementById("curve_form").value;

      // 標準データheight_standard---------------------
      // phpからjsonデータを持ってくる
      const height_standard_array = JSON.parse('<?php echo $json_array_height_standard; ?>');
      // 連想配列を列ごとに配列にする
      const 月齢_array = height_standard_array.map(item => item.月齢)
      const 標準負2SD_array = height_standard_array.map(item => item.標準負2SD)
      const 標準負1SD_array = height_standard_array.map(item => item.標準負1SD)
      const 標準_array = height_standard_array.map(item => item.標準)
      const 標準正1SD_array = height_standard_array.map(item => item.標準正1SD)
      const 標準正2SD_array = height_standard_array.map(item => item.標準正2SD)

      // 個人入力データbody_input---------------------
      // phpからjsonデータを持ってくる
      const body_input_array = JSON.parse('<?php echo $json_array_body_input; ?>');
      // 連想配列を列ごとに配列にする
      const height_array = body_input_array.map(item => item.height)

      // 標準データheight_standard---------------------
      // 0〜?歳までの配列にする
      const 月齢s = 月齢_array.slice(0, str);
      const 標準負2SDs = 標準負2SD_array.slice(0, str);
      const 標準負1SDs = 標準負1SD_array.slice(0, str);
      const 標準s = 標準_array.slice(0, str);
      const 標準正1SDs = 標準正1SD_array.slice(0, str);
      const 標準正2SDs = 標準正2SD_array.slice(0, str);

      // 個人入力データbody_input---------------------
      // 0〜1歳までの配列にする
      const ななheights = height_array.slice(0, str);
      //------------------------------------------------


      // グラフをHTMLに表示する-------------------------------
      // canvas要素（ID：myChart）を取得し変数ctxに入力
      const ctx = document.getElementById("myLineChart");
      const myLineChart = new Chart(ctx, { //描画するグラフを、new Chart()によって設定
        type: 'line', //折れ線グラフ

        data: {
          // データの軸ラベル
          labels: 月齢s,

          // データセット
          datasets: [{
            //折れ線グラフ
            label: '標準+2SD',
            data: 標準正2SDs,
            // lineTension: 0, //直線にする
            borderColor: "rgba(255, 99, 132, 0.1)",
            backgroundColor: "rgba(255, 99, 132, 0.2)",
            yAxisID: 'y1',
            fill: '4'
          }, {
            //折れ線グラフ
            label: '標準+1SD',
            data: 標準正1SDs,
            // lineTension: 0, //直線にする
            borderColor: "rgba(255, 99, 132, 0.1)",
            backgroundColor: "rgba(0,0,0,0)",
            yAxisID: 'y1'
          }, {
            //折れ線グラフ
            label: '標準',
            data: 標準s,
            // lineTension: 0, //直線にする
            borderColor: "rgba(255, 99, 132, 0.1)",
            backgroundColor: "rgba(0,0,0,0)",
            yAxisID: 'y1',
          }, {
            //折れ線グラフ
            label: '標準-1SD',
            data: 標準負1SDs,
            // lineTension: 0, //直線にする
            borderColor: "rgba(255, 99, 132, 0.1)",
            backgroundColor: "rgba(0,0,0,0)",
            yAxisID: 'y1'
          }, {
            //折れ線グラフ
            label: '標準-2SD',
            data: 標準負2SDs,
            // lineTension: 0, //直線にする
            borderColor: "rgba(255, 99, 132, 0.1)",
            backgroundColor: "rgba(0,0,0,0)",
            yAxisID: 'y1'
          }, {
            //折れ線グラフ
            label: 'なな',
            data: ななheights,
            // lineTension: 0, //直線にする
            borderColor: "rgb(255, 0, 0)",
            backgroundColor: "rgba(0,0,0,0)",
            yAxisID: 'y1'




          }]
        },

        options: {
          responsive: true,
          title: {
            display: true,
            text: '身長の推移'
          },
          scales: { //軸設定
            yAxes: [{ //y軸設定
              id: 'y1', //左軸
              position: 'left',
              ticks: {
                // borderColor: 'rgb(255, 99, 132)',
                suggestedMax: 90,
                suggestedMin: 0,
                stepSize: 10,
                callback: function(value, index, values) {
                  return value + 'cm'
                }
              },
              scaleLabel: {
                display: true,
                labelString: '身長'
              }
            }]
          },
          elements: {
            point: {
              radius: 1
            }
          },
        },
      });

    }


    // getCSV(); //最初に実行される
  </script>


</body>

</html>