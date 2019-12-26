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
  $sql = 'SELECT * FROM tbtest';
  // 1回だけ使用するSQL文はqueryを用いる
  // https://www.javadrive.jp/php/pdo/index7.html
  $stmt = $pdo->query($sql);
  // 複数県のデータを取得fetchAll
  // https://bituse.info/php/37
  $results = $stmt->fetchAll();
  foreach ($results as $row) {
      echo $row["id"]." ".$row["name"]." ".$row["comment"]."<br>";
  }
  echo "<hr>";
?>
</body>

</html>