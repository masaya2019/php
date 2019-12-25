<?php
if (!(empty($_POST["text"]))) {
    $hensu = $_POST["text"];
    $filename = "mission_2-4.txt";
    $fp = fopen($filename, "a");
    fwrite($fp, $hensu."\n");
    fclose($fp);
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>Document</title>
</head>

<body>
  <form action="mission_2-4.php" method="POST">
    <input type="text" name="text" value="コメント">
    <input type="submit" value="送信">
  </form>
  <?php
  $filename = 'mission_2-4.txt';
  // ファイルの存在チェック
  // https://www.flatflag.nir87.com/file_exists-888
  if (file_exists($filename)) {
      // ファイルの読み取り
      // https://ponk.jp/php/file/read
      $file = file($filename);
      foreach ($file as $text) {
          echo $text."<br>";
      }
  }
?>
</body>

</html>