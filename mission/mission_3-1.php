<?php
// 名前とコメントが入力されているか？
if (!(empty($_POST["personName"])) && !(empty($_POST["comment"]))) {
    $personName = $_POST["personName"];
    $comment = $_POST["comment"];
    // 現在の日時を取得
    date_default_timezone_set('Asia/Tokyo');
    $time = date('Y/m/d H:i:s');
    $filename = "mission_3-1.txt";
    // ファイルが存在するかをチェックする
    // https://www.flatflag.nir87.com/file_exists-888
    if (file_exists($filename)) {
        // ファイルの行数をカウントする
        // https://so-zou.jp/web-app/tech/programming/php/file/lines.htm
        $postNum = count(file($filename)) + 1;
    } else {
        $postNum = 1;
    }
    $fp = fopen($filename, "a");
    // ファイルに書き込み
    fwrite($fp, $postNum."<>".$personName."<>".$comment."<>".$time."\n");
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
  <!--ここのmission_3-X-X.phpは必ず変えること！-->
  <form action="mission_3-1.php" method="post">
    <p>名前：<input type="text" name="personName"></p>
    <p>コメント：<input type="text" name="comment"></p>
    <input type="submit" value="送信">
  </form>
</body>

</html>