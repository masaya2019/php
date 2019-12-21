<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>Document</title>
</head>

<body>
  <!--新規投稿フォーム / ここのmission_3-X-X.phpは必ず変えること！-->
  <form action="mission_3-3.php" method="post">
    <p>名前：<input type="text" name="personName" placeholder="名前"></p>
    <p>コメント：<input type="text" name="comment" placeholder="コメント"></p>
    <input type="submit" value="送信">
  </form>
  <!--削除対象番号指定用フォーム / ここのmission_3-X-X.phpは必ず変えること！-->
  <form action="mission_3-3.php" method="post">
    <p>削除対象番号：<input type="text" name="deleteNumber" placeholder="削除対象番号"></p>
    <input type="submit" value="削除">
  </form>
  <?php
  $filename = "mission_3-3.txt";
  // 新規投稿
  // 名前とコメントが入力されている？
  if (!(empty($_POST["personName"])) && !(empty($_POST["comment"]))) {
      $personName = $_POST["personName"];
      $comment = $_POST["comment"];
      // 現在の日時を取得
      date_default_timezone_set('Asia/Tokyo');
      $time = date('Y/m/d H:i:s');
      // ファイルは存在するか？　＆　ファイルが空ではないか？
      if (file_exists($filename) && (!(empty(file($filename))))) {
          // 最後の行の番号+1
          $file_data = file($filename);
          $get_line = $file_data[count($file_data)-1];
          $text = explode("<>", $get_line);
          $postNum = $text[0] + 1;
      } else {
          $postNum = 1;
      }
      $fpa = fopen($filename, "a");
      // ファイルに書き込み
      fwrite($fpa, $postNum."<>".$personName."<>".$comment."<>".$time."\n");
      fclose($fpa);
  // 削除番号
  // 削除フォームに入力されてるか？
  } elseif (!(empty($_POST["deleteNumber"]))) {
      $deleteNumber = $_POST["deleteNumber"];
      $file_array = array();
      // ファイルが存在するか？
      if (file_exists($filename)) {
          $fpr = fopen($filename, 'r');
          // 配列に入れる
          while (!feof($fpr)) {
              array_push($file_array, fgets($fpr));
          }
          fclose($fpr);
          // ファイルに書き込む
          $fpw = fopen($filename, 'w');
          foreach ($file_array as $value) {
              $text = explode("<>", $value);
              if ($text[0] != $deleteNumber) {
                  // 削除済みのものを書き込む
                  fwrite($fpw, $value);
              }
          }
          fclose($fpw);
      }
  }
  // ファイルを読ん込み表示する
  if (file_exists($filename)) {
      $fpr = fopen($filename, 'r');
      while (!feof($fpr)) {
          $txt = fgets($fpr);
          $text = explode("<>", $txt);
          $printText = "";
          foreach ($text as $value) {
              $printText .= $value." ";
          }
          echo "<p>".$printText."</p>";
      }
      fclose($fpr);
  }
  ?>
</body>

</html>