<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>Document</title>
</head>

<body>
  <?php
  echo "start";
  $dsn = "mysql:dbname=******;host=localhost";
  $user = "******";
  $password = "******";
  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
  echo "end";
?>
</body>

</html>