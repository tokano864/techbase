<?php 
    // DB接続設定
	$dsn = 'mysql:dbname=******;host=******';
	$user = '******';
	$password = '******';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $sql=$pdo->prepare("INSERT INTO tbtest(name,comment) VALUE(:name,:comment)");
    $sql->bindParam(':name',$name,PDO::PARAM_STR);
    $sql->bindParam(':comment',$comment,PDO::PARAM_STR);
    
    $name='onamae';
    $comment='commentdesu';
    $sql->execute();
?>
