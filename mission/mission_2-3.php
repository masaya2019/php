<?php
if (!(empty($_POST["text"]))) {
    $hensu = $_POST["text"];
    $filename = "mission_2-3.txt";
    // 追記に変更"w"=>"a"
    $fp = fopen($filename, "a");
    // 改行コードを入れる
    // https://qiita.com/dayone80/items/00ab49e2d02be6a3bc87
    fwrite($fp, $hensu."\n");
    fclose($fp);
    date_default_timezone_set('Asia/Tokyo');
    $time = date('Y年m月d日 H時i分');
}
?>
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
  if (!(empty($_POST["text"]))) {
      if ($_POST["text"] == "完成！") {
          echo "おめでとう！";
      } else {
          echo "<p>".$time."に".$_POST["text"]."を受け付けました。</p>";
      }
  }
/*
＜問題点＞
2-3で追加書き込みの反映がされない...

＜解決策＞
$filename = "mission_2-1.txt";
<form action="mission_2-1.php" method="POST">
↓
$filename = "mission_2-3.txt";
<form action="mission_2-3.php" method="POST">

＜原因＞
2-1をコピーして使っていたので
$filename = "mission_2-1.txt";
<form action="mission_2-1.php" method="POST">
と2-1に飛ぶようになっていた
*/
?>
</body>

</html>