<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>mision_3</title>
    </head>
    <body>
 	
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

    
    $sql = 'SELECT * FROM tbkeizi';
    $stmt = $pdo->query($sql);
    // if(!empty($_POST['hennsyuu'])){
    if($_POST["hennsyuu"] >= 1){
      $results = $stmt->fetchAll();
      foreach ($results as $row){
        // $lines =(file($filename,FILE_IGNORE_NEW_LINES));
        // foreach($lines as $line){
          // $word = explode("<>",$line);
          if($row['id'] == $_POST["hennsyuu"]){
            $num = $row['id'];
            $namae = $row['name'] ;
            $komennto = $row['comment'] ;
          break;
      
          
        }  
      }
    }
    ?>
    
    
    <form action="keizihen.php" method="post">
        <input type="text" name="name" placeholder="名前" value ="<?=$namae?>" >
        <input type="text" name="comment" placeholder="コメント" value="<?=$komennto?>"> 
        <input type="hidden" name="hidden" value="<?=$num?>">
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