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
  //削除する投稿番号
  $id = 3;
  $sql = 'delete from tbtest where id=:id';
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  // 表示
  $sql = 'SELECT * FROM tbtest';
  $stmt = $pdo->query($sql);
  $results = $stmt->fetchAll();
  foreach ($results as $row) {
      //$rowの中にはテーブルのカラム名が入る
      echo $row['id'].' '.$row['name'].' '.$row['comment'].'<br>';
  }
  echo "<hr>";
?>
</body>

</html>