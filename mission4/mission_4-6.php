<?php 
    // DB接続設定
	$dsn = 'mysql:dbname=tb220531db;host=localhost';
	$user = 'tb-220531';
	$password = 'mTRmcFfg8Y';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $sql='SELECT*FROM tbtest';
    $stmt=$pdo->query($sql);
    $results=$stmt->fetchAll();
    foreach($results as $row){
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
        echo "<hr>";
    }
?>