<?php
  $filename = "mission_3-5.txt";
  $editName = "";
  $editComment = "";
  $editNumber = "";
  // 編集番号
  // 編集フォームに入力されているか？
  if (!(empty($_POST["editNumber"]))) {
      $tempEditNumber = $_POST["editNumber"];
      if (file_exists($filename)) {
          // ファイルを読み込んで配列に入れる
          $file_array = temp_array($filename);
          if (!empty($file_array)) {
              foreach ($file_array as $value) {
                  $text = explode("<>", $value);
                  // 編集対象番号と一致するか？
                  // $text[0] == $editNumberだけだとforeachの最後は必ず""となりtrueとなってしまった
                  if (($text[0] == $tempEditNumber) && ($text[0] != "")) {
                      $editName = $text[1];
                      $editComment = $text[2];
                      $editNumber = $tempEditNumber;
                  }
              }
          }
      }
  }
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>Document</title>
</head>

<body>
  <!--新規投稿フォーム / ここのmission_3-X-X.phpは必ず変えること！-->
  <form action="mission_3-5.php" method="post">
    <p>名前：<input type="text" name="personName" placeholder="名前"
        value="<?php echo $editName ?>"></p>
    <p>コメント：<input type="text" name="comment" placeholder="コメント"
        value="<?php echo $editComment ?>"></p>
    <!--hidden contents-->
    <input type="hidden" name="editNum"
      value="<?php echo $editNumber ?>">
    <input type="submit" value="送信">
  </form>
  <!--削除対象番号指定用フォーム / ここのmission_3-X-X.phpは必ず変えること！-->
  <form action="mission_3-5.php" method="post">
    <p>削除対象番号：<input type="text" name="deleteNumber" placeholder="削除対象番号"></p>
    <input type="submit" value="削除">
  </form>
  <!--編集対象番号指定用フォーム / ここのmission_3-X-X.phpは必ず変えること！-->
  <form action="mission_3-5.php" method="post">
    <p>編集対象番号：<input type="text" name="editNumber" placeholder="編集対象番号"></p>
    <input type="submit" value="編集">
  </form>
  <?php
  $filename = "mission_3-5.txt";
  // 新規投稿
  // 名前とコメントが入力されている？
  if (!(empty($_POST["personName"])) && !(empty($_POST["comment"])) && $_POST["editNum"] == "") {
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
  // 編集
  } elseif (!(empty($_POST["personName"])) && !(empty($_POST["comment"]))&& !(empty($_POST["editNum"]))) {
      $personName = $_POST["personName"];
      $comment = $_POST["comment"];
      $editNum = $_POST["editNum"];
      // ファイルが存在するか？
      if (file_exists($filename)) {
          $temp_array = array();
          // ファイルを読み込んで配列に入れる
          $file_array = temp_array($filename);
          foreach ($file_array as $value) {
              $text = explode("<>", $value);
              if ($text[0] == $editNum) {
                  // 現在の日時を取得
                  date_default_timezone_set('Asia/Tokyo');
                  $time = date('Y/m/d H:i:s');
                  // 編集番号と一致する時書き換える
                  $value = $editNum."<>".$personName."<>".$comment."<>".$time."\n";
              }
              array_push($temp_array, $value);
          }
          // ファイルに書き込む
          $fpw = fopen($filename, 'w');
          foreach ($temp_array as $value) {
              fwrite($fpw, $value);
          }
          fclose($fpw);
      }
      // 削除
  // 削除フォームに入力されてるか？
  } elseif (!(empty($_POST["deleteNumber"]))) {
      $deleteNumber = $_POST["deleteNumber"];
      // ファイルが存在するか？
      if (file_exists($filename)) {
          // ファイルを読み込んで配列に入れる
          $file_array = temp_array($filename);
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
  // ファイルを読み込み表示する
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
  /* 関数 */
  // temp_arrayの作成
  function temp_array($filename)
  {
      $file_array = array();
      $fpr = fopen($filename, 'r');
      // 配列に入れる
      while (!feof($fpr)) {
          array_push($file_array, fgets($fpr));
      }
      fclose($fpr);
      return $file_array;
  }
  ?>
</body>

</html>