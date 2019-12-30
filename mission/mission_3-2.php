<?php
// 名前とコメントが入力されているか？
if (!(empty($_POST["personName"])) && !(empty($_POST["comment"]))) {
    $personName = $_POST["personName"];
    $comment = $_POST["comment"];
    // 現在の日時を取得
    date_default_timezone_set('Asia/Tokyo');
    $time = date('Y/m/d H:i:s');
    $filename = "mission_3-2.txt";
    // 投稿番号の決定
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
      // ファイルの読み取り
      // https://ponk.jp/php/file/read
      $file_array = file($filename);
      foreach ($file_array as $text) {
          // explodeでテキストを分割する
          // https://blog.codecamp.jp/php-explode
          $newText = explode("<>", $text);
          $printText = "";
          // <>を" "に変換する
          foreach ($newText as $value) {
              $printText .= $value." ";
          }
          echo "<p>".$printText."</p>";
      }
  }
  ?>
</body>

</html>