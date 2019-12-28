<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>mission_5-1</title>
</head>

<body>
  <?php
    // 初期設定
    $editName = "";
    $editComment = "";
    $editNumber = "";
    $errmsg = "";
    // DBに接続
    $pdo = accessMySql();
    /*========================
    // 新規投稿フォーム（新規）
    //======================*/
    // 名前・コメントがあり、編集対象番号が空の時
    if (!(empty($_POST["personName"])) && !(empty($_POST["comment"])) && $_POST["editNum"] == "") {
        $personName = $_POST["personName"];
        $comment = $_POST["comment"];
        // パスワードあるなし
        if (!(empty($_POST["password"])) || $_POST["password"] == 0) {
            $password = $_POST["password"];
        } else {
            $password = "";
        }
        // DBにデータを挿入
        insertMySql($pdo, $personName, $comment, $password);
    }
    // issetで送信しないときにはエラーを表示しない
    if (isset($_POST["personName"]) && $_POST["editNum"] == "") {
        // 名前が空白
        if ($_POST["personName"] == "") {
            $errmsg = "ERROR!!名前を入力してください";
        } else {
            if (isset($_POST["comment"]) && $_POST["editNum"] == "") {
                // コメントが空白
                if ($_POST["comment"]== "") {
                    $errmsg = "ERROR!!コメントを入力してください";
                }
            }
        }
    }

    /*========================
    // 新規投稿フォーム（編集）
    //======================*/
    if (!(empty($_POST["personName"])) && !(empty($_POST["comment"]))&& !(empty($_POST["editNum"]))) {
        $personName = $_POST["personName"];
        $comment = $_POST["comment"];
        $editNum = $_POST["editNum"];
        // パスワードあるなし
        if (!(empty($_POST["password"])) || $_POST["password"] == 0) {
            $password = $_POST["password"];
        } else {
            $password = "";
        }
        // idの一致するデータを取り出す
        $results = getSameIdData($editNum, $pdo);
        // パスワードがありのときパスワードが一致すれば編集可能
        if ($password != "") {
            // パスワードが一致したとき
            if ($results['password'] == $password) {
                // DBのデータを書き換える
                editMySql($editNum, $personName, $comment, $pdo);
            } else {
                // パスワードが不一致の時
                if ($results['password'] == "") {
                    $errmsg = "ERROR!!パスワードが設定されていないため編集できません";
                } else {
                    $errmsg = "ERROR!!編集用のパスワードが違います！";
                }
            }
        }
    }
    // issetで送信しないときにはエラーを表示しない
    if (isset($_POST["personName"]) && $_POST["editNum"] != "") {
        // 名前が空白
        if ($_POST["personName"] == "") {
            $errmsg = "ERROR!!編集した名前を入力してください";
        } else {
            if (isset($_POST["comment"]) && $_POST["editNum"] != "") {
                // コメントが空白
                if ($_POST["comment"]== "") {
                    $errmsg = "ERROR!!編集したコメントを入力してください";
                }
            }
        }
    }

    /*==============
    // 削除フォーム
    //============*/
    if (!(empty($_POST["deleteNumber"])) && (!(empty($_POST["deletePassword"])) || $_POST["deletePassword"] == 0)) {
        $deleteNumber = $_POST["deleteNumber"];
        $deletePassword = $_POST["deletePassword"];
        // idの一致するデータを取り出す
        $results = getSameIdData($deleteNumber, $pdo);
        // 一致するidがあるかどうか調べる
        if ($results) {
            // パスワードがありのときパスワードが一致すれば削除可能
            if ($deletePassword != "") {
                // パスワードが一致したとき
                if ($results['password'] == $deletePassword) {
                    // DBからデータを削除
                    deleteMySql($deleteNumber, $pdo);
                } else {
                    // パスワードが不一致の時
                    if ($results['password'] == "") {
                        $errmsg = "ERROR!!パスワードが設定されていないため削除できません";
                    } else {
                        $errmsg = "ERROR!!削除用のパスワードが違います！";
                    }
                }
            }
        } else {
            $errmsg = "ERROR!!一致するデータが存在しません<br>削除対象番号を再入力してください";
        }
    }
    // issetで送信しないときにはエラーを表示しない
    if (isset($_POST["deleteNumber"])) {
        // 削除対象番号が空白
        if ($_POST["deleteNumber"] == "") {
            $errmsg = "ERROR!!削除対象番号を入力してください";
        } else {
            if (isset($_POST["deletePassword"])) {
                // パスワードが空白
                if ($_POST["deletePassword"] == "") {
                    $errmsg = "ERROR!!パスワードを入力してください";
                }
            }
        }
    }

    /*==============
    // 編集フォーム
    //============*/
    if (!(empty($_POST["editNumber"])) && (!(empty($_POST["editPassword"])) || $_POST["editPassword"] == 0)) {
        $tempEditNumber = $_POST["editNumber"];
        $editPassword = $_POST["editPassword"];
        // idの一致するデータを取り出す
        $results = getSameIdData($tempEditNumber, $pdo);
        // 一致するidがあるかどうか調べる
        if ($results) {
            // パスワードがありのときパスワードが一致すれば削除可能
            if ($editPassword != "") {
                // パスワードが一致したとき
                if ($results['password'] == $editPassword) {
                    // データをフォームに表示
                    $editName = $results["name"];
                    $editComment = $results["comment"];
                    $editNumber = $results["id"];
                } else {
                    // パスワードが不一致の時
                    if ($results['password'] == "") {
                        $errmsg = "ERROR!!パスワードが設定されていないため編集できません";
                    } else {
                        $errmsg = "ERROR!!編集用のパスワードが違います！";
                    }
                }
            }
        } else {
            $errmsg = "ERROR!!一致するデータが存在しません<br>編集対象番号を再入力してください";
        }
    }
    // issetで送信しないときにはエラーを表示しない
    if (isset($_POST["editNumber"])) {
        // 編集対象番号が空白
        if ($_POST["editNumber"] == "") {
            $errmsg = "ERROR!!編集対象番号を入力してください";
        } else {
            if (isset($_POST["editPassword"])) {
                // パスワードが空白
                if ($_POST["editPassword"] == "") {
                    $errmsg = "ERROR!!パスワードを入力してください";
                }
            }
        }
    }

    /*==========
    // 関数一覧
    //=========*/
    // 現在時刻の取得
    function getPresentTime()
    {
        // 現在の日時を取得
        date_default_timezone_set('Asia/Tokyo');
        return date('Y/m/d H:i:s');
    }
    // passwordの
    // DBに接続+Table作成
    function accessMySql()
    {
        $dsn = "mysql:dbname=******;host=localhost";
        $user = "******";
        $password = "******";
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        // tableが存在していなければtableを作成
        $sql = "CREATE TABLE IF NOT EXISTS forum (id INT AUTO_INCREMENT PRIMARY KEY, name char(32), comment TEXT, time DATETIME, password VARCHAR(10))";
        $pdo->query($sql);
        return $pdo;
    }
    // SQL文に変数を入れたいときはprepare・executeを用いる（変数が不要な時はqueryでok!!）
    // 一致するidのデータを取得する
    function getSameIdData($id, $pdo)
    {
        $sql = $pdo -> prepare("SELECT * FROM forum WHERE id = :id");
        $sql -> bindParam(':id', $id, PDO::PARAM_INT);
        $sql -> execute();
        $results = $sql->fetch();
        return $results;
    }
    // DBにデータを挿入（新規）
    function insertMySql($pdo, $personName, $comment, $password)
    {
        $time = getPresentTime();
        $sql = $pdo -> prepare("INSERT INTO forum (name, comment, time, password) VALUES (:name, :comment, :time, :password)");
        $sql -> bindParam(':name', $personName, PDO::PARAM_STR);
        $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
        $sql -> bindParam(':time', $time, PDO::PARAM_STR);
        $sql -> bindParam(':password', $password, PDO::PARAM_STR);
        $sql -> execute();
    }
    // DBのデータを書き換える（編集）
    function editMySql($editNum, $personName, $comment, $pdo)
    {
        $time = getPresentTime();
        $sql = $pdo -> prepare("UPDATE forum SET name = :name, comment = :comment, time = :time WHERE id = :id");
        $sql -> bindParam(':id', $editNum, PDO::PARAM_INT);
        $sql -> bindParam(':name', $personName, PDO::PARAM_STR);
        $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
        $sql -> bindParam(':time', $time, PDO::PARAM_STR);
        $sql -> execute();
    }
    // DBからデータを削除
    function deleteMySql($deleteNumber, $pdo)
    {
        $sql = $pdo -> prepare("DELETE FROM forum WHERE id = :id");
        $sql -> bindParam(':id', $deleteNumber, PDO::PARAM_INT);
        $sql -> execute();
    }
    // 投稿を表示
    function displayPosts($pdo)
    {
        $sql = 'SELECT * FROM forum';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row) {
            echo "<p>".$row['id'].' '.$row['name'].' '.$row['comment']." ".$row['time']." ".$row['password'].'</p>';
        }
    }
  ?>
  <!--ここからHTML-->
  <h1>掲示板</h1>
  <!--新規投稿フォーム-->
  <p>【　投稿フォーム　】</p>
  <form action="mission_5-1.php" method="post">
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
  <!--削除対象番号指定用フォーム-->
  <p>【　削除フォーム　】</p>
  <form action="mission_5-1.php" method="post">
    <input type="text" name="deleteNumber" placeholder="削除対象番号">
    <input type="password" name="deletePassword" placeholder="パスワード">
    <input type="submit" value="削除">
  </form>
  <!--編集対象番号指定用フォーム-->
  <p>【　編集フォーム　】</p>
  <form action="mission_5-1.php" method="post">
    <input type="text" name="editNumber" placeholder="編集対象番号">
    <input type="password" name="editPassword" placeholder="パスワード">
    <input type="submit" value="編集">
  </form>
  <?php
    echo "<p>".$errmsg."</p>";
  ?>
  <hr>
  <p>【　投稿一覧　】</p>
  <?php
    // 投稿の表示
    displayPosts($pdo);
  ?>
</body>

</html>