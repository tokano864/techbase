<?php 
    // DB接続設定
	$dsn = 'mysql:dbname=******;host=******';
	$user = '******';
	$password = '******';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $sql='drop table tbtest';
    $stmt=$pdo->query($sql);
?>
