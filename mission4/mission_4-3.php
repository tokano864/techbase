<?php 
    // DB接続設定
	$dsn = 'mysql:dbname=tb220531db;host=localhost';
	$user = 'tb-220531';
	$password = 'mTRmcFfg8Y';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $sql='SHOW TABLES';
    $result=$pdo->query($sql);
    foreach($result as $row){
        echo $row[0];
        echo '<br>';
    }
    echo "<hr>";
?>