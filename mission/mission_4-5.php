<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>Document</title>
</head>

<body>
  <?php
  /* 下の3行は外部にアップする時必ず消すこと！ */
  $dsn = "mysql:dbname=******;host=localhost";
  $user = "******";
  $password = "******";
  // PDOとはPHP Data Objectsのこと
  // $db = new PDO('データベースの種類:host=接続先アドレス;dbname=データベース名', 'ユーザー名', 'パスワード');
  // https://qiita.com/nogson/items/48613a621e1add883826
  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
  // prepare()は、execute()関数によって実行されるSQLステートメントを準備
  // https://blog.codecamp.jp/programming-php-pdo-mysql-1
  // https://www.php.net/manual/ja/pdostatement.bindvalue.php
  $sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
  $sql -> bindParam(':name', $name, PDO::PARAM_STR);
  $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
  $name = 'masaya';
  $comment = 'hello!!';
  $sql -> execute();
  echo "<hr>";
?>
</body>

</html>