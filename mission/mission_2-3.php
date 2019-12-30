<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>Document</title>
</head>

<body>
  <form action="mission_2-3.php" method="POST">
    <input type="text" name="text" value="コメント">
    <input type="submit" value="送信">
  </form>
  <?php
  // 投稿が空でないとき
  if (!(empty($_POST["text"]))) {
      $hensu = $_POST["text"];
      $filename = "mission_2-3.txt";
      // ファイルに書き込む（追記）
      // 追記に変更"w"=>"a"
      $fp = fopen($filename, "a");
      // 改行コードを入れる
      // https://qiita.com/dayone80/items/00ab49e2d02be6a3bc87
      fwrite($fp, $hensu."\n");
      fclose($fp);
      // 現在時刻の取得
      date_default_timezone_set('Asia/Tokyo');
      $time = date('Y年m月d日 H時i分');
      // 受け取った投稿内容の表示
      if ($_POST["text"] == "完成！") {
          echo "おめでとう！";
      } else {
          echo "<p>".$time."に".$_POST["text"]."を受け付けました。</p>";
      }
  }
?>
</body>

</html>