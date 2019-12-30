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
  <form action="mission_2-2.php" method="POST">
    <input type="text" name="text" value="コメント">
    <input type="submit" value="送信">
  </form>
  <?php
  // $_POST["text"]の中身が空(empty)でないとき(!)
  // https://qiita.com/wakahara3/items/bb7c8d7a1673b161abe7
  // issetでもできそう？ https://geek-memo.com/isset-empty/
  if (!(empty($_POST["text"]))) {
      $hensu = $_POST["text"];
      $filename = "mission_2-2.txt";
      $fp = fopen($filename, "w");
      fwrite($fp, $hensu);
      fclose($fp);
      date_default_timezone_set('Asia/Tokyo');
      $time = date('Y年m月d日 H時i分');
      // 下に表示する
      if ($_POST["text"] == "完成！") {
          echo "おめでとう！";
      } else {
          echo "<p>".$time."に".$_POST["text"]."を受け付けました。</p>";
      }
  }

?>
</body>

</html>