<?php
    // 受け取っていないときはNotice: Undefined index: text in～が表示される
    $hensu = $_POST["text"];
    $filename = "mission_2-1.txt";
    $fp = fopen($filename, "w");
    fwrite($fp, $hensu);
    fclose($fp);
    // 現在時刻の取得 https://agohack.com/get-date-time-format/
    // タイムゾーンの変更 http://www.promeshi.com/archives/2452
    date_default_timezone_set('Asia/Tokyo');
    $time = date('Y年m月d日 H時i分');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>Document</title>
</head>

<body>
  <!--
    GETとPOSTの違い https://wa3.i-3-i.info/diff7method.html
    GET:urlにデータをくっつけてサーバに送る　※パスワードには使わないこと！
    POST:見えないところにデータをくっつけて送る
    PHPでフォームからデータを受け取る方法 https://techacademy.jp/magazine/4955#sec6
  -->
  <form action="mission_2-1.php" method="POST">
    <input type="text" name="text" value="コメント">
    <input type="submit" value="送信">
  </form>
  <?php
  echo "<p>".$time."に".$_POST["text"]."を受け付けました。</p>";
?>
</body>

</html>