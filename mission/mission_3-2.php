<?php
// 名前とコメントが入力されているか？
if (!(empty($_POST["personName"])) && !(empty($_POST["comment"]))) {
    $personName = $_POST["personName"];
    $comment = $_POST["comment"];
    // 現在の日時を取得
    date_default_timezone_set('Asia/Tokyo');
    $time = date('Y/m/d H:i:s');
    $filename = "mission_3-2.txt";
    // ファイルが存在するかをチェックする
    // https://www.flatflag.nir87.com/file_exists-888
    if (file_exists($filename)) {
        // ファイルの行数をカウントする
        // https://so-zou.jp/web-app/tech/programming/php/file/lines.htm
        $postNum = count(file($filename)) + 1;
    } else {
        $postNum = 1;
    }
    $fpa = fopen($filename, "a");
    // ファイルに書き込み
    fwrite($fpa, $postNum."<>".$personName."<>".$comment."<>".$time."\n");
    fclose($fpa);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>Document</title>
</head>

<body>
  <!--ここのmission_3-X-X.phpは必ず変えること！-->
  <form action="mission_3-2.php" method="post">
    <p>名前：<input type="text" name="personName" placeholder="名前"></p>
    <p>コメント：<input type="text" name="comment" placeholder="コメント"></p>
    <input type="submit" value="送信">
  </form>
  <?php
  $filename = "mission_3-2.txt";
  // ファイルを読み込み
  if (file_exists($filename)) {
      $fpr = fopen($filename, 'r');
      while (!feof($fpr)) {
          $txt = fgets($fpr);
          // explodeでテキストを分割する
          // https://blog.codecamp.jp/php-explode
          $text = explode("<>", $txt);
          $printText = "";
          foreach ($text as $value) {
              $printText .= $value." ";
          }
          echo "<p>".$printText."</p>";
          //var_dump($text);
      }
      fclose($fpr);
  }
  /*
  ＜問題点＞
  エラー文
  Warning: A non-numeric value encountered
  Notice: A non well formed numeric value encountered
  ＜解決策＞
  $printText += $value." ";
  ↓
  $printText .= $value." ";
  ＜原因＞
  文字の連結は「.=」を用いる
  他の言語との違いを認識していなかった
  */
  ?>
</body>

</html>