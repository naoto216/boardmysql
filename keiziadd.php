<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>mision_3</title>
    </head>
    <body>
    <form action="keiziadd.php" method="post">
        <input type="text" name="name" placeholder="名前" >
 <input type="text" name="comment" placeholder="コメント">
        <input type="hidden" name="hidden">
        <input type="password"  placeholder="パスワード">
        <input type="submit" name="submit">
    </form>
    <form action="keizinum.php" method="post">
        <input type="number" name="hennsyuu" placeholder="編集する番号">
        <input type="submit" name="submit" value="編集">
    </form>
    <form action="keizidel.php" method="post">
        削除する番号<input type="number" name="number" >
        <input type="password" name="password" placeholder="パスワード">
        <input type="submit" name="submit" value="削除">
    </form>
        
 	
    <?php
    $dsn = 'ユーザー名';
    $user = 'データベース名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    $sql = "CREATE TABLE IF NOT EXISTS tbkeizi"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT"
    .");";
    $stmt = $pdo->query($sql);
    
    $sql = $pdo -> prepare("INSERT INTO tbkeizi (name, comment) VALUES (:name, :comment)");
    $name = $_POST['name'];
    $comment = $_POST['comment']; 
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    $sql -> execute();
    
    $sql = 'SELECT * FROM tbkeizi';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
      //$rowの中にはテーブルのカラム名が入る
      echo $row['id'].',';
      echo $row['name'].',';
      echo $row['comment'].'<br>';
    }
    
    ?>
      </body>
  </html>