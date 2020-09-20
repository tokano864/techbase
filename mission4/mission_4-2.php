<?php 
    // DB接続設定
	$dsn = 'mysql:dbname=tb220531db;host=localhost';
	$user = 'tb-220531';
	$password = 'mTRmcFfg8Y';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    //table作成
    $sql="CREATE TABLE IF NOT EXISTS tbtest"
    ."("
    ."id INT AUTO_INCREMENT PRIMARY KEY,"
    ."name char(32),"
    ."comment TEXT"
    .");";
    
    $stmt=$pdo->query($sql);

?>