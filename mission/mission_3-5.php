<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>掲示板</title>
</head>

<body>
  <h1>掲示板</h1>
  <?php
    /*
    // 編集フォーム送信した編集番号とパスワードがデータにあれば新規作成フォームのところにデータを表示する
    */
    $filename = "mission_3-5.txt";
    $editName = "";
    $editComment = "";
    $editNumber = "";
    $errorMessage = "";
    // 編集番号
    // 編集フォームに入力されているか？
    if (!(empty($_POST["editNumber"])) && !(empty($_POST["editPassword"]))) {
        $tempEditNumber = $_POST["editNumber"];
        $editPassword = $_POST["editPassword"];
        if (file_exists($filename)) {
            // ファイルを読み込んで配列に入れる
            $file_array = temp_array($filename);
            if (!empty($file_array)) {
                foreach ($file_array as $value) {
                    $text = explode("<>", $value);
                    // 編集対象番号と一致するか？
                    // $text[0] == $editNumberだけだとforeachの最後は必ず""となりtrueとなってしまった
                    if (($text[0] == $tempEditNumber) && ($text[0] != "")) {
                        // password一致してる？
                        if ($text[4] == $editPassword) {
                            $editName = $text[1];
                            $editComment = $text[2];
                            $editNumber = $tempEditNumber;
                        } else {
                            // 編集フォームでパスワード違うとき
                            $errorMessage = "passwordが違います";
                        }
                    }
                }
            }
        }
    }
    /*
    // 新規投稿フォームで名前とコメントが入力されていればファイルに書き込む
    // パスワードは任意
    */
    // 名前とコメントが入力されている？
    if (!(empty($_POST["personName"])) && !(empty($_POST["comment"])) && $_POST["editNum"] == "") {
        echo "test";
        $personName = $_POST["personName"];
        $comment = $_POST["comment"];
        // パスワードあるなし
        if (!(empty($_POST["password"]))) {
            $password = $_POST["password"];
        } else {
            $password = "";
        }
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
        fwrite($fpa, $postNum."<>".$personName."<>".$comment."<>".$time."<>".$password."<>\n");
        fclose($fpa);
    /*
    // 新規投稿フォームに編集番号、名前、コメントが入力されている
    // パスワードが一致したときだけ編集
    */
    // 名前とコメントと編集番号があるか？
    } elseif (!(empty($_POST["personName"])) && !(empty($_POST["comment"]))&& !(empty($_POST["editNum"]))) {
        $personName = $_POST["personName"];
        $comment = $_POST["comment"];
        $editNum = $_POST["editNum"];
        // パスワードあるなし
        if (!(empty($_POST["password"]))) {
            $password = $_POST["password"];
        } else {
            $password = "";
        }
        // ファイルが存在するか？パスワードは空ではないか？
        if (file_exists($filename) && ($password != "")) {
            $temp_array = array();
            // ファイルを読み込んで配列に入れる
            $file_array = temp_array($filename);
            foreach ($file_array as $value) {
                $text = explode("<>", $value);
                if ($text[0] == $editNum) {
                    if ($text[4] == $password) {
                        // 現在の日時を取得
                        date_default_timezone_set('Asia/Tokyo');
                        $time = date('Y/m/d H:i:s');
                        // 編集番号と一致する時書き換える
                        $value = $editNum."<>".$personName."<>".$comment."<>".$time."<>".$password."<>\n";
                    } else {
                        $errorMessage = "passwordが違います";
                    }
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
    } elseif (!(empty($_POST["deleteNumber"])) && !(empty($_POST["deletePassword"]))) {
        $deleteNumber = $_POST["deleteNumber"];
        $deletePassword = $_POST["deletePassword"];
        // ファイルが存在するか？
        if (file_exists($filename)) {
            // ファイルを読み込んで配列に入れる
            $file_array = temp_array($filename);
            // ファイルに書き込む
            $fpw = fopen($filename, 'w');
            foreach ($file_array as $value) {
                $text = explode("<>", $value);
                // 番号一致でもパスワードが違う
                if ($text[0] == $deleteNumber && $text[4] != $deletePassword) {
                    fwrite($fpw, $value);
                    $errorMessage = "passwordが違います";
                // 番号違う
                } elseif ($text[0] != $deleteNumber) {
                    fwrite($fpw, $value);
                }
            }
            fclose($fpw);
        }
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

  <!--新規投稿フォーム / ここのmission_3-X-X.phpは必ず変えること！-->
  <p>【　投稿フォーム　】</p>
  <form action="mission_3-5.php" method="post">
    <input type="text" name="personName" placeholder="名前"
      value="<?php echo $editName ?>">
    <input type="text" name="comment" placeholder="コメント"
      value="<?php echo $editComment ?>">
    <input type="password" name="password" placeholder="パスワード">
    <!--hidden contents-->
    <input type="hidden" name="editNum"
      value="<?php echo $editNumber ?>">
    <input type="submit" value="送信">
  </form>
  <!--削除対象番号指定用フォーム / ここのmission_3-X-X.phpは必ず変えること！-->
  <p>【　削除フォーム　】</p>
  <form action="mission_3-5.php" method="post">
    <input type="text" name="deleteNumber" placeholder="削除対象番号">
    <input type="password" name="deletePassword" placeholder="パスワード">
    <input type="submit" value="削除">
  </form>
  <!--編集対象番号指定用フォーム / ここのmission_3-X-X.phpは必ず変えること！-->
  <p>【　編集フォーム　】</p>
  <form action="mission_3-5.php" method="post">
    <input type="text" name="editNumber" placeholder="編集対象番号">
    <input type="password" name="editPassword" placeholder="パスワード">
    <input type="submit" value="編集">
  </form>

  <p><?php echo $errorMessage ?>
  </p>
  <hr>
  <p>【　投稿一覧　】</p>

  <?php
  /*
  // ここに投稿を表示する
  */
  // ファイルを読み込み表示する
  if (file_exists($filename)) {
      $fpr = fopen($filename, 'r');
      while (!feof($fpr)) {
          $txt = fgets($fpr);
          $text = explode("<>", $txt);
          $printText = "";
          $count = 0;
          foreach ($text as $value) {
              // passwordを表示しない
              if ($count < 4) {
                  $printText .= $value." ";
                  $count++;
              } else {
                  break;
              }
          }
          echo "<p>".$printText."</p>";
      }
      fclose($fpr);
  }

  ?>

</body>

</html>