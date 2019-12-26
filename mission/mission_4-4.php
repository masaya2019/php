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
  // sql文を書く
  // CREATE TABLE IF NOT EXISTS tbtest (id INT AUTO_INCREMENT PRIMARY KEY,name char(32),comment TEXT);
  // CREATE TABLE IF NOT EXISTS tbtestでtbtestというテーブルが存在しなければtbtestというテーブルを作成
  $sql = "CREATE TABLE IF NOT EXISTS tbtest"
    ." ("
    // カラム1：id(主キーかつ番号を自動インクリメント)
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    // カラム2：name(char型32文字)
    // https://www.dbonline.jp/mysql/type/index3.html
    . "name char(32),"
    // カラム3：comment(TEXT型文字数制限なし)
    // https://www.dbonline.jp/mysql/type/index6.html
    . "comment TEXT"
    .");";
  // queryとはsql分を即時実行&1回しか使わない
  // https://qiita.com/mitsuru793/items/45b2452284e321c7a5a9
  $stmt = $pdo->query($sql);
  // テーブル一覧を表示
  // https://26gram.com/mysql-show-tables
  $sql ='SHOW CREATE TABLE tbtest';
  $result = $pdo->query($sql);
  foreach ($result as $row) {
      echo $row[1]."<br>";
  }
  echo "<hr>";
?>
</body>

</html>