<?php 
    // DB接続設定
	$dsn = 'mysql:dbname=******;host=******';
	$user = '******';
	$password = '******';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $sql='SHOW CREATE TABLE tbtest';
    $result=$pdo -> query($sql);
    foreach($result as $row){
        echo $row[1];
    }
    echo "<hr>";
?>
