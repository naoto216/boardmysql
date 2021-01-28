<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>mision_3</title>
    </head>
    <body>
    <form action="keiziadd.php" method="post">
        <input type="text" name="name" placeholder="名前" >
        <input type="text" name="comment" placeholder="コメント" >
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
    $dsn = 'データベース名';
    $user = 'ユーザー名';
    $password = 'パスワード名';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    $sql = "CREATE TABLE IF NOT EXISTS tbkeizibasic"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT,"
    . "date DATETIME"
    .");";
    $stmt = $pdo->query($sql);
    
    if($_POST["name"] && $_POST["comment"]!=null){
          $id = $_POST["hidden"]; 
          $name = $_POST["name"];
          $comment = $_POST["comment"]; 
          $date = date("Y/m/d H:m:s");
          $sql = 'update tbkeizibasic set name=:name,comment=:comment,date=:date where id=:id';
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':name', $name, PDO::PARAM_STR);
          $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
          $stmt->bindParam(':id', $id, PDO::PARAM_INT);
          $stmt->bindParam(':date', $date, PDO::PARAM_STR);
          $stmt->execute();
        }
          
     $sql = 'SELECT * FROM tbkeizibasic';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
      //$rowの中にはテーブルのカラム名が入る
      echo $row['id'].',';
      echo $row['name'].',';
      echo $row['comment'].',';
      echo $row['date'].'<br>';
    }
    
    ?>
      </body>
  </html>